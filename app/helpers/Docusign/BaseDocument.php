<?php

    namespace Helpers\Docusign;

    use DocuSign\eSign\Configuration;
    use Exception;

    abstract class BaseDocument
    {
        protected $api;

        protected $documents = [];

        public function __construct(Configuration $config) {
            $this->api = new Docusign($config);
        }

        protected function tabs($data = []) {
            return array_reduce($this->documents, function($data, $document) {
                return new $document[0]($data, $document[1]);
            }, $data);
        }

        public function notifications($callback) {
            $this->api->notification($callback);
            return $this;
        }

        public function view($envelope) {
            return $this->api->view($envelope);
        }

        public function download($envelope) {
            return $this->api->download($envelope);
        }

        public function template($name) {
            $templates = array_filter($this->api->getTemplates()->getEnvelopeTemplates(),
                function($template) use ($name) {
                return preg_match("/^{$name}$/", $template['name']);
            });

            if(empty($templates)) {
                throw new Exception("Template: {$name} does not exist.");
            } else {
                return array_shift($templates);
            }
        }
    }
