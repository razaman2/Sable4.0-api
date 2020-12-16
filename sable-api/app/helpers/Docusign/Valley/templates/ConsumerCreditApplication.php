<?php
    
    namespace App\Helpers\Docusign\Valley\templates;
    
    use App\Helpers\Docusign\Template;
    
    class ConsumerCreditApplication extends Template {
        protected $sequence = 6;
        
        protected $name = 'Consumer Credit App';
    
        protected function socialSecurity($data) {
            $this->new('ssn_tabs')->setTabLabel("ssn")->setValue($data);
        }
    
        protected function customer($data) {
            $this->new('text_tabs')->setTabLabel("name")->setValue($data);
        }
    
        protected function birthDate($data) {
            $this->new('text_tabs')->setTabLabel("dob")->setValue($data);
        }
    
        protected function cellPhone($data) {
            $this->new('text_tabs')->setTabLabel("cell phone")->setValue($data);
        }
    
        protected function homePhone($data) {
            $this->new('text_tabs')->setTabLabel("home phone")->setValue($data);
        }
    
        protected function currentAddress($data) {
            $this->new('text_tabs')->setTabLabel("current address")->setValue($data);
        }
    
        protected function mailingAddress($data) {
            $this->new('text_tabs')->setTabLabel("mailing address")->setValue($data);
        }
        
        public function build(array $data) : array {
            $this->customer($data['subscriberName']);
            $this->birthDate($data['birthDate']);
            $this->socialSecurity($data['socialSecurity']);
            $this->cellPhone($data['cellPhone']);
            if(array_key_exists('homePhone', $data)) {
                $this->homePhone($data['homePhone']);
            }
            $this->currentAddress($data['currentAddress']);
            $this->mailingAddress($data['mailingAddress']);
            
            return parent::build($data);
        }
    }
