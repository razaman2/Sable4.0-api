<?php

    namespace Helpers\Docusign\VIO\templates;

    use Helpers\Docusign\Template;

    class NoticeOfAutoRenewal extends Template
    {
        protected $sequence = 3;
        //    order in packet in comparison with other templates

        protected $name = 'Notice of Auto Renewal';

        //    Title of document in docusign

        public function build(array $data) : array {
            //        if a function does not take an argument from the front end it must be called
            $this->process($data);

            return parent::build($data);
        }
    }
