<?php

    namespace Helpers\Docusign;

    use DocuSign\eSign\Configuration;

    class NewBaseDocument {
        private $api;

        public function __construct(Configuration $config) {
            $this->api = new Docusign($config);
        }

        public function notifications($callback) {
            $this->api->notification($callback);
        }

        public function view($envelope) {
            return $this->api->view($envelope);
        }

        public function download($envelope) {
            return $this->api->download($envelope);
        }
    }
