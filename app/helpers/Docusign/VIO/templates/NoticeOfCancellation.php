<?php

    namespace Helpers\Docusign\VIO\templates;

    use Helpers\Docusign\Template;
    use Carbon\Carbon;

    class NoticeOfCancellation extends Template
    {
        protected $sequence = 4;
        //    order in packet in comparison with other templates

        protected $name = 'Notice of Cancellation';
        //    Title of document in docusign

        //    Fields below
        //      Each data point on the document requires a function

        protected function dateOfTransaction() {
            //        parse today's date add 3 days explode is equivalent to split in JS
            $date = explode(' ', Carbon::parse()->addDays(3)->isoFormat('MMMM Do YY'));

            //        new is a helper for docusign integration it gives you the docusign tab to perform operations
            //            text tabs will need replaced in instances of radio buttons or checkboxes etc.
            //                                                                                            php template string
            $this->new('text_tabs')->setTabLabel("Cancellation Month Day")->setValue("{$date[0]} {$date[1]}");
            $this->new('text_tabs')->setTabLabel("Cancellation Year")->setValue($date[2]);
        }

        //    protected function address($address) {
        ////        new is a helper for docusign integration it gives you the docusign tab to perform operations
        //        $this->new('text_tabs')->setTabLabel("Property Address")->setValue($address['address1']);
        //        $this->new('text_tabs')->setTabLabel("Property City")->setValue($address['city']);
        //        $this->new('text_tabs')->setTabLabel("Property State")->setValue($address['state']);
        //        $this->new('text_tabs')->setTabLabel("Property Zip")->setValue($address['zip']);
        //    }

        public function build(array $data) : array {
            $this->dateOfTransaction();
            //        if a function does not take an argument from the front end it must be called
            //$this->process($data);

            return parent::build($data);
        }
    }
