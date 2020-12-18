<?php

    namespace Helpers\Docusign\VIO\templates;

    use Carbon\Carbon;
    use Helpers\Docusign\Template;

    class SecuritySystemSaleAndServicesAgreement extends Template
    {
        protected $sequence = 1;

        protected $name = 'Security System Sale and Services Agreement';

        protected function property($property) {
            $this->new('text_tabs')->setTabLabel("Property Address")->setValue($property['address']['address1']);
            $this->new('text_tabs')->setTabLabel("Property City")->setValue($property['address']['city']);
            $this->new('text_tabs')->setTabLabel("Property State")->setValue($property['address']['state']);
            $this->new('text_tabs')->setTabLabel("Property Zip")->setValue($property['address']['zip']);

            if(preg_match('/commercial/', $property['address']['type'])) {
                $this->new('checkbox_tabs')->setTabLabel("commercial")->setSelected(true);
                $this->new('text_tabs')->setTabLabel("Business Name")->setValue($property['companyName']);
            } else {
                $this->new('checkbox_tabs')->setTabLabel("residential")->setSelected(true);
            }
        }

        protected function signers($signers) {
            foreach($signers as $key => $signer) {
                if($signer['role'] === 'primary') {
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 Name")->setValue("{$signer['firstName']} {$signer['lastName']}");
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 Mobile")->setValue($signer['phone']);
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 1 Email")->setValue($signer['email']);
                } elseif($signer['role'] === 'secondary') {
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 2 Name")->setValue("{$signer['firstName']} {$signer['lastName']}");
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 2 Mobile")->setValue($signer['phone']);
                    $this->new('text_tabs')->setTabLabel("Agreement Signer 2 Email")->setValue($signer['email']);
                }
            }
        }

        protected function salesperson($salesperson) {
            $this->new('text_tabs')->setTabLabel("License Number")->setValue($salesperson['licenseNumber']);
            $this->new('text_tabs')->setTabLabel("Salesperson Name")->setValue("{$salesperson['firstName']} {$salesperson['lastName']}");
        }

        protected function billing($billing) {
            $this->new('text_tabs')->setTabLabel("Billing Activation Fee")->setValue(number_format($billing['activationFee'], 2));
            //$this->new('text_tabs')->setTabLabel("Billing Equipment Fee")->setValue($billing['equipmentFee']);
            //$this->new('text_tabs')->setTabLabel("Tax Integration To Avalara")->setValue($billing['taxAvalara']);
            $this->new('text_tabs')->setTabLabel("Billing Install Labor")->setValue(number_format($billing['installLaborCost'], 2));
            //$this->new('text_tabs')->setTabLabel("Discount")->setValue($billing['discounts']);
            //$this->new('text_tabs')->setTabLabel("Total Before Tax")->setValue($billing['totalBeforeTax']);
            $this->new('text_tabs')->setTabLabel("RMR Retry")->setValue(number_format($billing['rmr'], 2));
            //$this->new('text_tabs')->setTabLabel("Total")->setValue($billing['total']);
        }

        protected function calculation($data) {
            $total = number_format((intval($data['contract']['length']) * $data['billing']['rmr']), 2);
            $this->new('text_tabs')->setTabLabel("Calculation")->setValue($total);

            if(preg_match('/monthly/', $data['contract']['paymentDuration'])) {
                $monthly = number_format($data['billing']['rmr'], 2);
                $this->new('text_tabs')->setTabLabel("Total Contract Divided by Payment Term")->setValue($monthly);
            } elseif(preg_match('/quarterly/', $data['contract']['paymentDuration'])) {
                $quarterly = number_format(($data['billing']['rmr'] * 3), 2);
                $this->new('text_tabs')->setTabLabel("Total Contract Divided by Payment Term")->setValue($quarterly);
            }
        }

        protected function payments($billing) {
            foreach($billing as $key => $billing2) {
                if($billing2['type'] === 'credit card') {
                    $this->new('checkbox_tabs')->setTabLabel("creditCard")->setSelected(true);
                    $this->new('text_tabs')->setTabLabel("Billing Credit Card Num")->setValue($billing2['payment']['cardNumber']);
                    $this->new('text_tabs')->setTabLabel("CC Expiration")->setValue($billing2['payment']['expiration']);
                    $this->new('text_tabs')->setTabLabel("CC CCV")->setValue($billing2['payment']['cvv']);
                } elseif($billing2['type'] === 'ach') {
                    $this->new('checkbox_tabs')->setTabLabel("ach")->setSelected(true);
                    $this->new('text_tabs')->setTabLabel("Billing Routing No")->setValue($billing2['payment']['routingNumber']);
                    $this->new('text_tabs')->setTabLabel("Account No")->setValue($billing2['payment']['accountNumber']);
                }
            }
        }

        protected function event($event) {
            $today = Carbon::createFromDate("{$event['date']} {$event['time']}")->day;

            $days = [
                1,
                8,
                15,
                22,
            ];

            foreach($days as $day) {
                if(($today <= $day) && (($day - $today) < 7)) {
                    $this->new('checkbox_tabs')->setTabLabel("Checkbox {$day}")->setSelected(true);
                } elseif(($today > 22 && $today < 31)) {
                    $this->new('checkbox_tabs')->setTabLabel("Checkbox 1")->setSelected(true);
                }
            }
        }

        protected function contract($details) {
            $this->new('checkbox_tabs')->setTabLabel("landlineTelephone")->setSelected(in_array('landline telephone', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("cellularPrimary")->setSelected(in_array('cellular primary', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("cellularBackUp")->setSelected(in_array('cellular back-up', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("twoWayVoice")->setSelected(in_array('two way voice', $details['selections']));

            $this->new('checkbox_tabs')->setTabLabel("burglary")->setSelected(in_array('burglary', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("holdUp")->setSelected(in_array('hold up', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("medicalEmergency")->setSelected(in_array('medical emergency', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("internetPrimary")->setSelected(in_array('internet primary', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("internetBackup")->setSelected(in_array('internet back-up', $details['selections']));

            $this->new('checkbox_tabs')->setTabLabel("fireSmokeAlarm")->setSelected(in_array('fire/smoke alarm', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("abnormalTempDetection")->setSelected(in_array('abnormal temp detection', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("carbonMonoxideDetection")->setSelected(in_array('carbon monoxide detection', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("flood")->setSelected(in_array('flood', $details['selections']));
            $this->new('checkbox_tabs')->setTabLabel("other")->setSelected(in_array('other', $details['selections']));

            $this->new('text_tabs')->setTabLabel("Purchase Details Term 36 or 60")->setValue(ucfirst($details['length']));

            if(preg_match('/monthly/', $details['paymentDuration'])) {
                $this->new('checkbox_tabs')->setTabLabel("contractLength{$details['length']}")->setSelected(true);
            } else {
                $this->new('checkbox_tabs')->setTabLabel("quarterly{$details['length']}")->setSelected(true);
            }
        }

        protected function purchase($details) {
            $this->new('checkbox_tabs')->setTabLabel("extendedServicePlan")->setSelected($details['extendedServicePlan']);
            //$this->new('text_tabs')->setTabLabel("Purchase Details Term 36 or 60")->setValue($purchaseDetails['pdTerm']);
            //$this->new('text_tabs')->setTabLabel("Total Contract Divided by Payment Term")->setValue($purchaseDetails['contractDividedByTerm']);
            //$this->new('checkbox_tabs')->setTabLabel("ach")->setSelected(in_array('ach', $purchaseDetails));
            //
            //$this->new('checkbox_tabs')->setTabLabel("creditCard")->setSelected(in_array('creditCard', $purchaseDetails));
            //
            //$this->new('checkbox_tabs')->setTabLabel("1st")->setSelected(in_array('1st', $purchaseDetails));
            //
            //$this->new('checkbox_tabs')->setTabLabel("8th")->setSelected(in_array('8th', $purchaseDetails));
            //
            //$this->new('checkbox_tabs')->setTabLabel("15th")->setSelected(in_array('15th', $purchaseDetails));
            //
            //$this->new('checkbox_tabs')->setTabLabel("22nd")->setSelected(in_array('22nd', $purchaseDetails));
        }

        public function build(array $data) : array {
            $this->process($data);
            $this->calculation($data);

            return parent::build($data);
        }
    }
