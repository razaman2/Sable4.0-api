<?php

    namespace Helpers\Docusign\Interfaces;

    use DocuSign\eSign\Configuration;

    interface Authentication
    {
        public function __construct(Configuration $config);

        public function authenticate($auth);
    }
