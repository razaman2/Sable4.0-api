<?php

    namespace Helpers\Docusign\Interfaces;

    interface TemplateInterface {
        public function getTabs(array $data);
        public function build(array $data) : array;
        public function getLocalTemplates();
        public function getServerTemplates($templates = []);
    }
