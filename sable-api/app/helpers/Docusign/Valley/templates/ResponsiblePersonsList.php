<?php
    
    namespace App\Helpers\Docusign\Valley\templates;
    
    use App\Helpers\Docusign\Template;
    
    class ResponsiblePersonsList extends Template {
        protected $sequence = 7;
        
        protected $name = 'Responsible Persons List';
        
        protected function customer($data) {
            $this->new('text_tabs')->setTabLabel("name")->setValue($data);
        }
        
        protected function address($data) {
            $this->new('text_tabs')->setTabLabel("address")->setValue($data);
        }
        
        protected function cityState($data) {
            $this->new('text_tabs')->setTabLabel("city/state")->setValue($data);
        }
        
        protected function phone($data) {
            $this->new('text_tabs')->setTabLabel("phone")->setValue($data);
        }
        
        protected function passcode($data) {
            $this->new('text_tabs')->setTabLabel("passcode")->setValue($data);
        }
        
        public function contacts(array $data) {
            $contacts1 = $this->sorter($data);
            $contacts2 = array_splice($contacts1, 0, 4);
            array_walk($contacts2, function($contact, $index) {
                $location = ++$index;
                $this->new('text_tabs')->setTabLabel("ec{$location} name")->setValue("{$contact['firstName']} {$contact['lastName']}");
                
                $this->new('text_tabs')->setTabLabel("ec{$location} phone")->setValue($contact['phone']);
                
                if(array_key_exists('email', $contact)) {
                    $this->new('email_tabs')->setTabLabel("ec{$location} email")->setValue($contact['email']);
                }
            });
        }
        
        protected function sorter($arr) {
            usort($arr, function($a, $b) {
                if($a['callOrder'] === $b['callOrder']) {
                    return 0;
                }
                
                return ($a < $b) ? -1 : 1;
            });
            
            return $arr;
        }
        
        public function build(array $data) : array {
            $this->customer($data['subscriberName']);
            $this->address($data['address1']);
            $this->cityState("{$data['city']}, {$data['state']}");
            if(array_key_exists('phone', $data)) {
                $this->phone($data['phone']);
            }
            $this->passcode($data['passcode']);
            $this->contacts($data['contacts']);
            
            return parent::build($data);
        }
    }
