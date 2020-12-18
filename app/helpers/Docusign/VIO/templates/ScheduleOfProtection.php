<?php

    namespace Helpers\Docusign\VIO\templates;

    use Helpers\Docusign\Template;

    class ScheduleOfProtection extends Template
    {
        protected $sequence = 5;

        protected $name = 'Schedule of Protection';

        protected function event($date) {
            $this->new('text_tabs')->setTabLabel("Events Install Date")->setValue($date['date']);
        }

        protected function property($property) {
            $this->new('text_tabs')->setTabLabel("Property Address")->setValue($property['address']['address1']);
            $this->new('text_tabs')->setTabLabel("Property City")->setValue($property['address']['city']);
            $this->new('text_tabs')->setTabLabel("Property State")->setValue($property['address']['state']);
            $this->new('text_tabs')->setTabLabel("Property Zip")->setValue($property['address']['zip']);

            if(in_array('phone', $property['address'])) {
                $this->new('text_tabs')->setTabLabel("Property Home Phone")->setValue($property['address']['phone']);
            }

            if(preg_match('/commercial/', $property['address']['type'])) {
                $this->new('checkbox_tabs')->setTabLabel("commercial")->setSelected(true);
            } else {
                $this->new('checkbox_tabs')->setTabLabel("residential")->setSelected(true);
            }
        }

        protected function serviceType($serviceType) {
            $this->new('checkbox_tabs')->setTabLabel("landlineTelephone")->setSelected(in_array('landlineTelephone', $serviceType));

            $this->new('checkbox_tabs')->setTabLabel("cellularPrimarycellularPrimary")->setSelected(in_array('cellularPrimary', $serviceType));
        }

        // this will belong to the account and get pulled and fed on the front end
        protected function phone($phone) {
            $this->new('text_tabs')->setTabLabel("Property Home Phone")->setValue($phone->number);
        }

        protected function contacts($emergencyContacts) {
            foreach($emergencyContacts as $key => $contact) {
                if($contact['order'] === 1) {
                    $this->new('text_tabs')->setTabLabel("Emergency Contact 1 Name")->setValue("{$contact['firstName']} {$contact['lastName']}");
                    $this->new('text_tabs')->setTabLabel("Emergency Contact 1 Phone")->setValue($contact['phone']);
                    $this->new('text_tabs')->setTabLabel("Emergency Contact 1 Passcode")->setValue($contact['passcode']);
                } elseif($contact['order'] === 2) {
                    $this->new('text_tabs')->setTabLabel("Emergency Contact 2 Name")->setValue("{$contact['firstName']} {$contact['lastName']}");
                    $this->new('text_tabs')->setTabLabel("Emergency Contact 2 Phone")->setValue($contact['phone']);
                    $this->new('text_tabs')->setTabLabel("Emergency Contact 2 Passcode")->setValue($contact['passcode']);
                }
            }
        }

        protected function signers($signers) {
            foreach($signers as $key => $signer) {
                if($signer['role'] === 'primary') {
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 First Name")->setValue($signer['firstName']);
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 Last Name")->setValue($signer['lastName']);
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 Email")->setValue($signer['email']);
                } elseif($signer['role'] === 'secondary') {
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 2 First Name")->setValue($signer['firstName']);
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 2 Last Name")->setValue($signer['lastName']);
                }
            }
        }


        protected function billing($billing) {
            //$this->new('text_tabs')->setTabLabel("Billing Address")->setValue($billing['address']['address1']);
            //$this->new('text_tabs')->setTabLabel("Billing City")->setValue($billing['address']['city']);
            //$this->new('text_tabs')->setTabLabel("Billing State")->setValue($billing['address']['state']);
            //$this->new('text_tabs')->setTabLabel("Billing Zip")->setValue($billing['address']['zip']);
            $this->new('text_tabs')->setTabLabel("Billing Activation Fee")->setValue($billing['activationFee']);
            $this->new('text_tabs')->setTabLabel("Billing Install Labor")->setValue($billing['installLaborCost']);
            //$this->new('text_tabs')->setTabLabel("Discounts")->setValue($billing['discounts']);
            //$this->new('text_tabs')->setTabLabel("Total Before Tax")->setValue($billing['totalBeforeTax']);
            //$this->new('text_tabs')->setTabLabel("Tax")->setValue($billing['tax']);
            //$this->new('text_tabs')->setTabLabel("Total")->setValue($billing['total']);
        }

        protected function equipment(array $data) {
            $equipment = array_slice($data['list'], 0, 9);

            array_walk($equipment, function($equipment, $index) {
                $location = ++$index;

                $this->new('text_tabs')->setTabLabel("QTY {$location}")->setValue($equipment['quantity']);

                $this->new('text_tabs')->setTabLabel("Cost Per {$location}")->setValue(number_format($equipment['price'], 2));

                $this->new('text_tabs')->setTabLabel("Total {$location}")->setValue(number_format(($equipment['price'] * $equipment['quantity']), 2));

                $this->new('text_tabs')->setTabLabel("Equipment {$location}")->setValue(substr($equipment['name'], 0, 42));
            });

            $this->new('text_tabs')->setTabLabel("Total")->setValue(number_format($data['total'], 2));
        }


        public function build(array $data) : array {
            $this->serviceType($data);

            $this->process($data);

            return parent::build($data);
        }
    }
