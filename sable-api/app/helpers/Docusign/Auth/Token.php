<?php

    namespace Helpers\Docusign\Auth;

    use Helpers\Docusign\Interfaces\Authentication;
    use DocuSign\eSign\Configuration;

    class Token implements Authentication
    {
        protected $config;

        public function __construct(Configuration $config) {
            $this->config = $config;
        }

        public function authenticate($auth) {
            return $this->config->addDefaultHeader("Authorization", $auth);
        }
    }
