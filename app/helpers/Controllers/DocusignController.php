<?php

    namespace Helpers\Controllers;

    use App\Http\Controllers\Controller;
    use App\Mail\DocusignAgreement;
    use DocuSign\eSign\Model\EnvelopeEvent;
    use DocuSign\eSign\Model\EnvelopeSummary;
    use DocuSign\eSign\Model\EventNotification;
    use DocuSign\eSign\Model\RecipientEvent;
    use Helpers\Docusign\Docusign;
    use Helpers\Docusign\TemplateFactory;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;

    class DocusignController extends Controller
    {
        public function send(Request $request) {
            $docusign = app()->make(Docusign::class);

            $data = $request->input('data', []);

            $template = $this->getTemplate();

            $envelope = (new $template($docusign, $data))->configure($data);

            $envelope->setStatus('sent');

            $envelope->setEventNotification($this->getNotifications());

            $response = $docusign->send($envelope);

            return response()->json($this->createResponse($response));
        }

        public function view(Request $request) {
            $response = app()->make(Docusign::class)->view($request->input('envelope'), $request->input('sequence', 0));

            return response()->json(['url' => $response->getUrl()]);
        }

        public function download(Request $request) {
            /** @var \SplFileObject $file */
            return app()->make(Docusign::class)->download($request->input('envelope'));

            //return base64_encode(file_get_contents($response->getFileInfo()));
        }

        protected function getNotifications() : EventNotification {
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
                    $success = Mail::to($current['email'])->send(new DocusignAgreement($current, $property, $this->getSigningLink($envelope)));

                    $status[$current['id']]['email'] = is_null($success) ? $current['email'] : false;
                }

                if(in_array('phone', $notifications)) {
                    $status[$current['id']]['phone'] = $current['phone'];
                }

                $status[$current['id']]['signed'] = false;

                return $status;
            });
        }

        protected function getSigningLink($envelope) : string {
            return sprintf("%s/Docusign-Signing?envelope=%s", env('FIREBASE_FUNCTIONS_URL'), $envelope);
        }

        public function getTemplate() {
            return call_user_func(TemplateFactory::getTemplate(request()->input('companyId')), request()->input('data.contract.service'));
        }

        public function createResponse(EnvelopeSummary $response) : array {
            return [
                'bulk_envelope_status' => $response->getBulkEnvelopeStatus(),
                'envelope_id' => $response->getEnvelopeId(),
                'error_details' => $response->getErrorDetails(),
                'status' => $response->getStatus(),
                'status_date_time' => $response->getStatusDateTime(),
                'uri' => $response->getUri(),
                'notifications' => ($response->getStatus() === 'sent') ? $this->notifySigner($response->getEnvelopeId()) : [],
            ];
        }
    }
