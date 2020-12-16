<?php

    namespace Helpers\Docusign\Exceptions;

    use Exception;

    class TemplateNotUploadedException extends Exception {
        public function __construct($name) {
            parent::__construct("Template ({$name}) does not exist. Please upload to clients account.");
        }
    }
