<?php

    namespace Helpers\Docusign\Exceptions;

    use Exception;

    class InvalidDocumentNameException extends Exception
    {
        protected $message = 'please setup a name for the document you are trying to map';
    }
