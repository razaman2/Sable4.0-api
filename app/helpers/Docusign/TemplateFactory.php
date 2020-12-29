<?php

    namespace Helpers\Docusign;

    use Helpers\Docusign\VIO\packets\SecurityPacket;

    class TemplateFactory
    {
        protected static $templates = [
            'UOoG7r1DgErDtGIZxTt5' => [
                'security packet' => SecurityPacket::class
            ]
        ];

        public static function getTemplate($id) {
            return function($name) use ($id) {
                return self::$templates[$id][strtolower($name)];
            };
        }
    }
