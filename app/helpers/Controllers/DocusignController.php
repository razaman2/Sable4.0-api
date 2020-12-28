<?php

    namespace Helpers\Controllers;

    use App\Http\Controllers\Controller;
    use App\Mail\DocusignAgreement;
    use DocuSign\eSign\Model\EnvelopeEvent;
    use DocuSign\eSign\Model\EnvelopeSummary;
    use DocuSign\eSign\Model\EventNotification;
    use DocuSign\eSign\Model\RecipientEvent;
    use Helpers\Docusign\Auth\DocusignAuthFactory;
    use Helpers\Docusign\Docusign;
    use Helpers\Docusign\TemplateFactory;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;

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
                return response()->json($this->createResponse($response));
            }
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
                (new RecipientEvent())->setRecipientEventStatusCode('completed'),
            ]);
        }

        protected function notifySigner($envelope) {
            return array_reduce(request()->input('data.signers', []), function($status, $current) use ($envelope) {
                $notifications = request()->input("data.contract.notifications.{$current['id']}", []);

                $property = request()->input('data.property', []);

                if(in_array('email', $notifications)) {
                    $success = Mail::to($current['email'])->send(new DocusignAgreement($current, $property, $this->url($envelope)));

                    $status[$current['id']]['email'] = is_null($success) ? $current['email'] : false;
                }

                if(in_array('phone', $notifications)) {
                    dump('not yet implemented!');
                    $status[$current['id']]['phone'] = $current['phone'];
                }

                $status[$current['id']]['signed'] = false;

                return $status;
            });
        }

        protected function url($envelope) {
            return sprintf("%s/Docusign-Signing?envelope=%s", env('FIREBASE_FUNCTIONS_URL'), $envelope);
        }

        public function getTemplate(Request $request) {
            return TemplateFactory::getTemplate($request->input('companyId'))($request->input('data.contract.service'));
        }

        public function createResponse(EnvelopeSummary $response) {
            return [
                'bulk_envelope_status' => $response->getBulkEnvelopeStatus(),
                'envelope_id' => $response->getEnvelopeId(),
                'error_details' => $response->getErrorDetails(),
                'status' => $response->getStatus(),
                'status_date_time' => $response->getStatusDateTime(),
                'uri' => $response->getUri(),
                'notifications' => $this->notifySigner($response->getEnvelopeId()),
            ];
        }
    }
