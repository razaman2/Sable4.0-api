<?php

    namespace Helpers\Docusign\Auth;

    use DocuSign\eSign\Configuration;
    use Helpers\Docusign\Exceptions\InvalidAuthTypeException;

    class DocusignAuthFactory
    {
        public static function authenticate($auth) : Configuration {
            if(is_string($auth)) {
                $config = (new Token(new Configuration()));
            } elseif(is_array($auth)) {
                $config = (new Login(new Configuration()));
            } else {
                throw new InvalidAuthTypeException();
            }

            return $config->authenticate($auth);
        }
    }
