<?php

    namespace Helpers\Controllers;

    use App\Http\Controllers\Controller;
    use DocuSign\eSign\Model\EnvelopeEvent;
    use DocuSign\eSign\Model\EventNotification;
    use DocuSign\eSign\Model\Signer;
    use Helpers\Docusign\Auth\DocusignAuthFactory;
    use Helpers\Docusign\Docusign;
    use Helpers\Docusign\TemplateFactory;
    use Illuminate\Http\Request;

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

            return base64_encode(file_get_contents($response->getFileInfo()));
        }

        protected function callback() {
            return (new EventNotification())->setUrl(env('FIREBASE_FUNCTIONS_URL').'/Docusign-Status')->setEnvelopeEvents([
                (new EnvelopeEvent())->setEnvelopeEventStatusCode("sent"),
                (new EnvelopeEvent())->setEnvelopeEventStatusCode("completed"),
            ]);
        }

        protected function notifySigner($auth, $id) {
            $docusign = new Docusign($auth);

            $recipients = $docusign->recipients($id);

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

            array_walk($signerNotifications, function($notification) use ($currentSigner) {
                dump("{$currentSigner['firstName']} {$currentSigner['lastName']} will be notified via {$notification}");
            });

            //if($signers->getCurrentRoutingOrder() <= $signers->getRecipientCount()) {
            //    $signer = array_reduce(request()->input('data.signers', []), function($current, $item) {
            //        if($current['role'] === '') return $current;
            //    });
            //}

            // get template signers from docusign
            // find the signer payload from the request body that matches the first docusign signer
            // find the notification methods for the signer in payload contract notifications
            // notify signer via the chosen notification methods.

            //return array_reduce(request()->input('notifications'), function($accumulator, $current) use ($response) {
            //    if(preg_match('/text/i', $current)) {
            //        $text = new Text(new Mobile(request()->input('data.phone1')));
            //        $text->setMessage(sprintf("Your agreement is ready to be signed. Please click the link below.\r\n\r\n%s", $this->url($response)));
            //        $accumulator['text'] = $text->send()->status;
            //    }
            //    if(preg_match('/email/i', $current)) {
            //        $view = view('customerEmails.eAgreement')->with([
            //            'request' => request(),
            //            'url' => $this->url($response),
            //        ]);
            //        $email = new Email(request()->input('data.email'));
            //        $email->setSubject('Service Agreement')->setFrom(request()->input('company.name'))->setBody('Your agreement is ready to be signed.')->setHtml($view->render());
            //        $accumulator['email'] = $email->send()->getMessage();
            //    }
            //
            //    return $accumulator;
            //}, []);
        }

        //protected function url($response) {
        //    return sprintf("%s/Docusign-Signing?account=%s&envelope=%s", env('FIREBASE_FUNCTIONS_URL'), request()->input('account'), $response->getEnvelopeId());
        //}

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
