<?php

    namespace Helpers\Docusign;

    use DocuSign\eSign\Model\DocumentTemplate;
    use DocuSign\eSign\Model\Recipients;
    use Helpers\Docusign\Exceptions\TemplateNotUploadedException;

    abstract class Template extends SableTabs
    {
        protected $name;
        protected $sequence = 1;

        /**
         * matching server template.
         * @var $templates DocumentTemplate
         */
        private $template;

        /**
         * list of recipients that need to interact with template.
         * @var $recipients Recipients
         */
        private $recipients;

        public function getName() {
            return $this->name;
        }

        public function getSequence() {
            return $this->sequence;
        }

        public function isIncluded(array $data) {
            return true;
        }

        public function getServerTemplates($templates = []) {
            return empty($templates) ? [$this->getServerTemplate()] : $templates;
        }

        public function getLocalTemplates() {
            return $this;
        }

        public function getRecipients() {
            if(!$this->recipients) {
                $this->recipients = $this->api->getTemplateRecipients($this->getServerTemplate()->getTemplateId());
            }

            return $this->recipients;
        }

        protected function new(string $tab_name) {
            $tab = preg_replace('/\[]/', '', self::$swaggerTypes[$tab_name]);
            if(array_key_exists($tab_name, $this->container)) {
                $this->container[$tab_name][] = new $tab();
            }

            return $this->container[$tab_name][count($this->container[$tab_name]) - 1];
        }

        public function getServerTemplate($templates = []) {
            if(!$this->template) {
                $this->template = array_reduce(empty($templates) ? $this->api->getTemplates()->getEnvelopeTemplates() : $templates, function($templates, $template) {
                    if(in_array($template->getName(), [$this->getName()])) {
                        return $template;
                    }

                    return $templates;
                }, []);

                throw_if(!$this->template, new TemplateNotUploadedException($this->getName()));
            }

            return $this->template;
        }

        protected function findTab($name) {
            return preg_replace('/\[]/', '', self::$swaggerTypes[$name]);
        }
    }
