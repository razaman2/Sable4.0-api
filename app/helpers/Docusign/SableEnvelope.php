<?php

    namespace Helpers\Docusign;

    use Helpers\Docusign\Interfaces\TemplateInterface;
    use DocuSign\eSign\Model\CompositeTemplate;
    use DocuSign\eSign\Model\EnvelopeDefinition;
    use DocuSign\eSign\Model\InlineTemplate;
    use DocuSign\eSign\Model\Recipients;
    use DocuSign\eSign\Model\ServerTemplate;

    class SableEnvelope extends EnvelopeDefinition {
        private $data;

        public function __construct(array $data) {
            parent::__construct();
            $this->data = $data;
        }

        public function build(TemplateInterface $template) {
            $compositeTemplates = array_map(function(Template $localTemplate) {
                return new CompositeTemplate([
                    'inline_templates' => [
                        new InlineTemplate([
                            'recipients' => new Recipients($this->getSigners($localTemplate)),
                            'sequence' => $localTemplate->getSequence(),
                        ]),
                    ],
                    'server_templates' => [
                        new ServerTemplate([
                            'template_id' => $localTemplate->getServerTemplate()->getTemplateId(),
                            'sequence' => $localTemplate->getSequence(),
                        ]),
                    ],
                ]);
            }, $template->getLocalTemplates());

            $this->setCompositeTemplates($compositeTemplates);

            return $this;
        }

        protected function getUser($role) {
            foreach($this->data['signers'] as $signer) {
                if($role === $signer['role']) {
                    return $signer;
                }
            }

            return false;
        }

        protected function getSigners(Template $template) {
            return array_reduce($template->getRecipients()->getSigners(), function($recipients, $signer) use ($template) {
                $user = $this->getUser($signer->getRoleName());

                if($user) {
                    $signer->setName("{$user['firstName']} {$user['lastName']}");
                    $signer->setEmail($user['email']);
                    $signer->setClientUserId($user['role']);
                    $signer->setTabs($template->getTabs($this->data));
                    $recipients['signers'][] = $signer;
                }

                return $recipients;
            }, ['signers' => []]);
        }

        protected function filteredTemplates(TemplateInterface $template) {
            return array_filter($template->getLocalTemplates(), function($template) {
                return $template->isIncluded($this->data);
            });
        }
    }
