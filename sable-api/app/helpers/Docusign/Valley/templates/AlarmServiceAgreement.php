<?php
    
    namespace App\Helpers\Docusign\Valley\templates;
    
    use App\Helpers\Docusign\Template;
    use Carbon\Carbon;

    class AlarmServiceAgreement extends Template {
        protected $sequence = 1;
        
        protected $name = 'Alarm Service Agreement';
        
        protected function agreementDate() {
            $date = explode(' ', Carbon::parse()->isoFormat('MMMM Do YY'));
            if(!empty($date)) {
                $this->new('text_tabs')->setTabLabel("agreement day")->setValue($date[1]);
                $this->new('text_tabs')->setTabLabel("agreement month")->setValue($date[0]);
                $this->new('text_tabs')->setTabLabel("agreement year")->setValue($date[2]);
            }
        }
    
        protected function systemType(array $data) {
            $this->new('checkbox_tabs')
                ->setTabLabel("takeover")
                ->setSelected(in_array('takeover', $data));
            
            $this->new('checkbox_tabs')
                ->setTabLabel("2")
                ->setSelected(in_array(2, $data));
            
            $this->new('checkbox_tabs')
                ->setTabLabel("3")
                ->setSelected(in_array(3, $data));
            
            $this->new('checkbox_tabs')
                ->setTabLabel("monitoring")
                ->setSelected(in_array('monitoring', $data));
            
            $this->new('checkbox_tabs')
                ->setTabLabel("contract repair service")
                ->setSelected(in_array('contractRepairService', $data));
            
            $this->new('checkbox_tabs')
                ->setTabLabel("6")
                ->setSelected(in_array(6, $data));
            
            $this->new('checkbox_tabs')
                ->setTabLabel("7")
                ->setSelected(in_array(7, $data));
        }
    
        protected function serviceType(array $data) {
            $this->new('checkbox_tabs')
                ->setTabLabel("landline")
                ->setSelected(in_array('landline', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("cell")
                ->setSelected(in_array('cell', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("radio")
                ->setSelected(in_array('radio', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("internet")
                ->setSelected(in_array('internet', $data));
        }
    
        protected function installationStart($data) {
            $date = explode(' ', Carbon::parse($data)->isoFormat('MMMM Do YY'));
            if(!empty($date)) {
                $this->new('text_tabs')
                    ->setTabLabel("installation start month/day")
                    ->setValue("{$date[0]} {$date[1]}");
    
                $this->new('text_tabs')
                    ->setTabLabel("installation start year")
                    ->setValue($date[2]);
            }
        }
    
        protected function installationEnd($data) {
            $date = explode(' ', Carbon::parse($data)->isoFormat('MMMM Do YY'));
            if(!empty($date)) {
                $this->new('text_tabs')
                    ->setTabLabel("installation end month/day")
                    ->setValue("{$date[0]} {$date[1]}");
    
                $this->new('text_tabs')
                    ->setTabLabel("installation end year")
                    ->setValue($date[2]);
            }
        }
    
        protected function equipmentNotes($data) {
            $this->new('text_tabs')
                ->setTabLabel('equipment-notes')
                ->setValue($data);
        }
    
        protected function equipment(array $data) {
            $equipment = array_slice($data, 0, 50);
            array_walk($equipment, function($equipment, $index) {
                $location = ++$index;
                $this->new('text_tabs')
                    ->setTabLabel("item{$location} qty")
                    ->setValue($equipment['quantity']);
            
                $this->new('text_tabs')
                    ->setTabLabel("item{$location} description")
                    ->setValue(substr($equipment['name'], 0, 53));
            });
        }
    
        protected function rmr($data) {
            $this->new('text_tabs')->setTabLabel("rmr")->setValue($data);
        }
    
        protected function frequency($data) {
            $this->new('text_tabs')->setTabLabel("frequency")->setValue($data);
        }
    
        protected function paymentCount($data) {
            $this->new('text_tabs')->setTabLabel("payment count")->setValue($data);
        }
    
        protected function term($data) {
            $this->new('text_tabs')->setTabLabel("term")->setValue($data);
        }
    
        protected function electronicPayment($data) {
            $this->new('checkbox_tabs')->setTabLabel("electronic payment")->setSelected($data);
        }
    
        protected function customer($data) {
            $this->new('text_tabs')->setTabLabel("name")->setValue($data);
        }
    
        protected function salesperson($data) {
            $this->new('text_tabs')->setTabLabel("salesperson")->setValue($data);
        }
    
        protected function address($data) {
            $this->new('text_tabs')->setTabLabel("address")->setValue($data);
        }
    
        protected function city($data) {
            $this->new('text_tabs')->setTabLabel("city")->setValue($data);
        }
    
        protected function state($data) {
            $this->new('text_tabs')->setTabLabel("state")->setValue($data);
        }
    
        protected function zip($data) {
            $this->new('zip_tabs')->setTabLabel("zip")->setValue($data);
        }
    
        protected function homePhone($data) {
            $this->new('text_tabs')->setTabLabel("home phone")->setValue($data);
        }
    
        protected function businessPhone($data) {
            $this->new('text_tabs')->setTabLabel("business phone")->setValue($data);
        }
    
        protected function installFee($data) {
            $this->new('text_tabs')->setTabLabel("install fee")->setValue($data);
        }
    
        protected function serviceFee($data) {
            $this->new('text_tabs')->setTabLabel("service fee")->setValue($data);
        }
    
        protected function billingAddress($data) {
            $this->new('text_tabs')->setTabLabel("billing address")->setValue($data);
        }
        
        public function build(array $data) : array {
            $this->customer($data['subscriberName']);
            $this->salesperson($data['salesperson']);
            $this->systemType($data['systemType']);
            $this->serviceType($data['serviceType']);
    
            $this->address($data['address1']);
            $this->city($data['city']);
            $this->state($data['state']);
            $this->zip($data['zip']);
            
            if(array_key_exists('homePhone', $data)) {
                $this->homePhone($data['homePhone']);
            }
            
            if(array_key_exists('businessPhone', $data)) {
                $this->businessPhone($data['businessPhone']);
            }
            
            if(array_key_exists('installationStart', $data)) {
                $this->installationStart($data['installationStart']);
            }
            
            if(array_key_exists('installationEnd', $data)) {
                $this->installationEnd($data['installationEnd']);
            }
    
            $this->billingAddress($data['billingAddress']);
            
            $this->equipment($data['equipment']);
            
            $this->rmr($data['rmr']);
            $this->term($data['term']);
            
            $this->installFee($data['installFee']);
            $this->serviceFee($data['serviceFee']);
            
            $this->frequency($data['frequency']);
            $this->paymentCount($data['paymentCount']);
    
            $this->electronicPayment(true);
            $this->agreementDate();
            
            if(array_key_exists('equipmentNotes', $data)) {
                $this->equipmentNotes($data['equipmentNotes']);
            }
            
            return parent::build($data);
        }
    }
