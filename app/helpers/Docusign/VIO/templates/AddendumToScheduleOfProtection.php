<?php

    namespace Helpers\Docusign\VIO\templates;

    use App\Helpers\Docusign\Template;

    class AddendumToScheduleOfProtection extends Template
    {
        protected $sequence = 2;
        //    order in packet in comparison with other templates

        protected $name = 'Addendum to Schedule of Protection';

        //    Title of document in docusign

        protected function address($address) {
            //        new is a helper for docusign integration it gives you the docusign tab to perform operations
            //            text tabs will need replaced in instances of radio buttons or checkboxes etc.

            $this->new('text_tabs')->setTabLabel("Property Address")->setValue($address['address1']);
            $this->new('text_tabs')->setTabLabel("Property City")->setValue($address['city']);
            $this->new('text_tabs')->setTabLabel("Property State")->setValue($address['state']);
            $this->new('text_tabs')->setTabLabel("Property Zip")->setValue($address['zip']);
            //        $this->new('radio_group_tabs')->setGroupName("install type")->setRadios([
            //            $this->new('radio_tab')->setSelected(true)->setValue($address['type']),
            //        ]);
        }

        protected function events($events) {
            //        new is a helper for docusign integration it gives you the docusign tab to perform operations
            //            text tabs will need replaced in instances of radio buttons or checkboxes etc.

            $this->new('text_tabs')->setTabLabel("Events Install Date")->setValue($events['installDate']);
            $this->new('text_tabs')->setTabLabel("Event Install Type")->setValue($events['type']);
            $this->new('text_tabs')->setTabLabel("Event Communication Type")->setValue($events['communication']);
            $this->new('text_tabs')->setTabLabel("Property Type")->setValue($events['propertyType']);
            $this->new('text_tabs')->setTabLabel("CS Number")->setValue($events['csNumber']);
            //        $this->new('radio_group_tabs')->setGroupName("install type")->setRadios([
            //            $this->new('radio_tab')->setSelected(true)->setValue($address['type']),
            //        ]);
        }

        protected function signers($signers) {
            foreach($signers as $key => $signer) {
                if($signer['role'] === 'Agreement Signer 1') {
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 Name")->setValue("{$signer['firstName']} {$signer['lastName']}");
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 Mobile")->setValue($signer['mobile']);
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 Email")->setValue($signer['email']);
                    $this->new('text_tabs')->setTabLabel("License Number")->setValue($signer['licenseNo']);
                } elseif($signer['role'] === 'Agreement Signer 2') {
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 2 Name")->setValue("{$signer['firstName']} {$signer['lastName']}");
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 2 Mobile")->setValue($signer['mobile']);
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 2 Email")->setValue($signer['email']);
                }
            }
        }

        protected function equipment(array $data) {

            $equipment = array_slice($data, 0, 16);
            array_walk($equipment, function($equipment, $index) {
                $location = ++$index;
                $this->new('text_tabs')->setTabLabel("QTY {$location}")->setValue($equipment['qty']);

                $this->new('text_tabs')->setTabLabel("Cost Per {$location}")->setValue($equipment['costPer']);

                $this->new('text_tabs')->setTabLabel("Total {$location}")->setValue($equipment['total']);

                $this->new('text_tabs')->setTabLabel("Actual {$location}")->setValue($equipment['actual']);

                $this->new('text_tabs')->setTabLabel("Points {$location}")->setValue($equipment['actual']);

                $this->new('text_tabs')->setTabLabel("Equipment {$location}")->setValue(substr($equipment['name'], 0, 22));
            });
        }

        protected function zones(array $data) {

            $zone = array_slice($data, 0, 16);
            array_walk($zone, function($zone, $index) {
                $location = ++$index;

                $this->new('text_tabs')->setTabLabel("Existing {$location}")->setValue($zone['existing']);

                $this->new('text_tabs')->setTabLabel("Zone Number {$location}")->setValue($zone['number']);

                $this->new('text_tabs')->setTabLabel("Event Type {$location}")->setValue($zone['type']);

                $this->new('text_tabs')->setTabLabel("Zone Name {$location}")->setValue(substr($zone['name'], 0, 22));
            });
        }

        public function build(array $data) : array {
            //        if a function does not take an argument from the front end it must be called
            $this->process($data);

            return parent::build($data);
        }
    }
