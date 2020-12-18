<?php

    namespace Helpers\Docusign\Auth;

    use Helpers\Docusign\Interfaces\Authentication;
    use DocuSign\eSign\Configuration;

    class Login implements Authentication  {

        protected $config;

        function __construct(Configuration $config) {
            $this->config = $config;
        }

        public function authenticate($auth) {
            return $this->config->addDefaultHeader("X-DocuSign-Authentication", json_encode($auth));
        }
    }
