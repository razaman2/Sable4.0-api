<?php

    namespace Helpers\Docusign;

    use DocuSign\eSign\Api\AuthenticationApi;
    use DocuSign\eSign\Api\AuthenticationApi\LoginOptions;
    use DocuSign\eSign\Api\EnvelopesApi;
    use DocuSign\eSign\Api\TemplatesApi;
    use DocuSign\eSign\Client\ApiClient;
    use DocuSign\eSign\Client\ApiException;
    use DocuSign\eSign\Configuration;
    use DocuSign\eSign\Model\EnvelopeDefinition;
    use DocuSign\eSign\Model\RecipientViewRequest;
    use DocuSign\eSign\Model\TemplateRole;

    class Docusign
    {
        protected $authentication;

        protected $callback;

        protected $roles = [];

        public function __construct(Configuration $config) {
            $this->authentication = new AuthenticationApi(new ApiClient($config));
        }

        public function download($envelope, $id = 'combined') {
            try {
                return (new EnvelopesApi($this->authentication->getApiClient()))
                    ->getDocument($this->account(), $id, $envelope);
            } catch(ApiException $e) {
                throw new \Exception(json_encode($e->getResponseBody()));
            }
        }

        public function get($envelope) {
            try {
                return (new EnvelopesApi($this->authentication->getApiClient()))
                    ->getEnvelope($this->account(), $envelope);
            } catch(ApiException $e) {
                throw new \Exception(json_encode($e->getResponseBody()));
            }
        }

        public function view($envelope, $sequence) {
            $signers = $this->recipients($envelope)->getSigners();

            $viewer = $signers[$sequence];

            $view = (new RecipientViewRequest())
                ->setUserName($viewer->getName())
                ->setEmail($viewer->getEmail())
                ->setAuthenticationMethod('none')
                ->setClientUserId($viewer->getClientUserId())
                ->setReturnUrl(env('DOCUSIGN_CALLBACK_URL'));

            try {
                return (new EnvelopesApi($this->authentication->getApiClient()))
                    ->createRecipientView($this->account(), $envelope, $view);
            } catch(ApiException $e) {
                throw new \Exception(json_encode($e->getResponseBody()));
            }
        }

        public function recipients($envelope) {
            try {
                return (new EnvelopesApi($this->authentication->getApiClient()))
                    ->listRecipients($this->account(), $envelope);
            } catch(ApiException $e) {
                throw new \Exception(json_encode($e->getResponseBody()));
            }
        }

        public function send(EnvelopeDefinition $envelope) {
            try {
                return (new EnvelopesApi($this->authentication->getApiClient()))
                    ->createEnvelope($this->account(), $envelope);
            } catch(ApiException $e) {
                throw new \Exception(json_encode($e->getResponseBody()));
            }
        }

        public function getTemplates() {
            try {
                return (new TemplatesApi($this->authentication->getApiClient()))
                    ->listTemplates($this->account());
            } catch(ApiException $e) {
                throw new \Exception(json_encode($e->getResponseBody()));
            }
        }

        public function getTemplateRecipients(string $id) {
            try {
                return (new TemplatesApi($this->authentication->getApiClient()))
                    ->listRecipients($this->account(), $id);
            } catch(ApiException $e) {
                throw new \Exception(json_encode($e->getResponseBody()));
            }
        }

        public function role($name) : TemplateRole {
            array_push($this->roles, new TemplateRole(['client_user_id' => time()]));
            return $this->roles[(count($this->roles) - 1)]->setRoleName($name);
        }

        public function notification($callback) {
            $this->callback = $callback;
            return $this;
        }

        protected function account() {
            try {
                return $this->authentication->login(new LoginOptions())
                    ->getLoginAccounts()[0]->getAccountId();
            } catch(ApiException $e) {
                throw new \Exception(json_encode($e->getResponseBody()));
            }
        }
    }
