<?php

    namespace Helpers\Docusign;

    use Helpers\Docusign\VIO\packets\SecurityPacket;

    class TemplateFactory
    {
        protected static $templates = [
            'UOoG7r1DgErDtGIZxTt5' => [
                'Security Packet' => SecurityPacket::class
            ]
        ];

        public static function getTemplate($id) {
            return function($name) use ($id) {
                return self::$templates[$id][$name];
            };
        }
    }
