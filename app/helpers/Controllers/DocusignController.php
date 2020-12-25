<?php

    namespace Helpers\Controllers;

    use App\Http\Controllers\Controller;
    use App\Mail\DocusignAgreement;
    use DocuSign\eSign\Model\EnvelopeEvent;
    use DocuSign\eSign\Model\EventNotification;
    use DocuSign\eSign\Model\RecipientEvent;
    use DocuSign\eSign\Model\Signer;
    use Helpers\Docusign\Auth\DocusignAuthFactory;
    use Helpers\Docusign\Docusign;
    use Helpers\Docusign\TemplateFactory;
    use Helpers\Docusign\VIO\packets\SecurityPacket;
    use Illuminate\Http\File;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Storage;

    //use Helpers\Docusign\Docusign;
    //use Helpers\Docusign\TemplateFactory;
    //use Helpers\Email\Email;
    //use Helpers\Text\Text;
    //use Helpers\Text\Validation\Mobile;
    //use DocuSign\eSign\Model\EnvelopeEvent;
    //use DocuSign\eSign\Model\EventNotification;

    class DocusignController extends Controller
    {
        public function send(Request $request) {
            $auth = $this->auth($request);

            $docusign = new Docusign($auth);

            $data = $request->input('data', []);

            $template = $this->getTemplate($request);

            $envelope = (new $template($docusign, $data))->configure($data);

            $envelope->setStatus('sent');

            $envelope->setEventNotification($this->callback());

            $response = $docusign->send($envelope);

            if($response->getStatus() === 'sent') {
                $this->notifySigner($auth, $response->getEnvelopeId());
            }

            return response()->json($this->createResponse($response));
        }

        protected function auth(Request $request) {
            return $request->input('test') ? DocusignAuthFactory::authenticate([
                'Username' => env('DOCUSIGN_DEV_USERNAME'),
                'Password' => env('DOCUSIGN_DEV_PASSWORD'),
                'IntegratorKey' => env('DOCUSIGN_DEV_INTEGRATOR_KEY'),
            ])->setHost(env('DOCUSIGN_DEV_HOST')) :

                DocusignAuthFactory::authenticate($request->input('auth'))->setHost(env('DOCUSIGN_PRO_HOST'));
        }

        public function view(Request $request) {
            $response = (new Docusign($this->auth($request)))->view($request->input('envelope'), $request->input('sequence', 0));

            return response()->json(['url' => $response->getUrl()]);
        }

        public function download(Request $request) {
            $response = (new Docusign($this->auth($request)))->download($request->input('envelope'));

            //return base64_encode(file_get_contents($response->getFileInfo()));

            return response()->file($response);
        }

        protected function callback() {
            return (new EventNotification())->setUrl(env('FIREBASE_FUNCTIONS_URL').'/Docusign-Status')->setEnvelopeEvents([
                (new EnvelopeEvent())->setEnvelopeEventStatusCode("sent"),
                (new EnvelopeEvent())->setEnvelopeEventStatusCode("completed"),
            ])->setRecipientEvents([
                (new RecipientEvent())->setRecipientEventStatusCode('completed')
            ]);
        }

        protected function notifySigner($auth, $envelope) {
            $docusign = new Docusign($auth);

            $recipients = $docusign->recipients($envelope);

            /**
             * @var $currentRecipient Signer
             */
            $currentRecipient = array_reduce($recipients->getSigners(), function($recipient, Signer $current) use ($recipients) {
                if($current->getRoutingOrder() === $recipients->getCurrentRoutingOrder()) {
                    $recipient = $current;
                }

                return $recipient;
            });

            $currentSigner = array_reduce(request()->input('data.signers', []), function($signer, $current) use ($currentRecipient) {
                if($current['role'] === $currentRecipient->getRoleName()) {
                    $signer = $current;
                }

                return $signer;
            });

            $signerNotifications = request()->input("data.contract.notifications.{$currentSigner['id']}", []);

            return array_reduce($signerNotifications, function($notifications, $notification) use ($currentSigner, $envelope) {
                $property = request()->input('data.property', []);

                if($notification === 'email') {
                    $status = Mail::to($currentSigner['email'])->send(
                        new DocusignAgreement($currentSigner, $property, $this->url($envelope)));

                    $notifications['email'] = $status;
                }

                if($notification === 'phone') {
                    dump('phone not implemented!');
                }

                return $notifications;
            }, ['id' => $currentSigner['id']]);
        }

        protected function url($envelope) {
            return sprintf("%s/Docusign-Signing?envelope=%s", env('FIREBASE_FUNCTIONS_URL'), $envelope);
        }

        public function getTemplate(Request $request) {
            return TemplateFactory::getTemplate($request->input('companyId'))($request->input('data.contract.service'));
        }

        public function createResponse($response) {
            return [
                'bulk_envelope_status' => $response->getBulkEnvelopeStatus(),
                'envelope_id' => $response->getEnvelopeId(),
                'error_details' => $response->getErrorDetails(),
                'status' => $response->getStatus(),
                'status_date_time' => $response->getStatusDateTime(),
                'uri' => $response->getUri(),
                'notifications' => \request()->input('data.contract.notifications')
                //'notifications' => $this->notify($response),
                //'url' => $this->url($response),
            ];
        }
    }
