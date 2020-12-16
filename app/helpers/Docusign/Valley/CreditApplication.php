<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;

    class CreditApplication extends TemplateTabs implements Defaultable
    {
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'credit']));
        }
        
        protected function name($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-subscriber-name")
                ->setXPosition(31)
                ->setYPosition(146)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function socialSecurity($data) {
            $this->new('ssn_tabs')
                ->setTabLabel("{$this->config['name']}-social-security")
                ->setXPosition(31)
                ->setYPosition(170)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function birthDate($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-birth-date")
                ->setXPosition(173)
                ->setYPosition(170)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function driversLicence($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-drivers-licence")
                ->setXPosition(311)
                ->setYPosition(170)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function homePhone($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-home-phone")
                ->setXPosition(31)
                ->setYPosition(194)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function workPhone($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-work-phone")
                ->setXPosition(173)
                ->setYPosition(195)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function cellPhone($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-cell-phone")
                ->setXPosition(312)
                ->setYPosition(194)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function faxPhone($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-fax-phone")
                ->setXPosition(411)
                ->setYPosition(195)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function mailingAddress($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-mailing-address")
                ->setXPosition(30)
                ->setYPosition(244)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function currentAddress($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-current-address")
                ->setXPosition(30)
                ->setYPosition(220)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function currentAddressYears($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-current-address-years")
                ->setXPosition(411)
                ->setYPosition(219)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function previousAddress($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-previous-address")
                ->setXPosition(30)
                ->setYPosition(268)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function previousAddressYears($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-previous-address-years")
                ->setXPosition(410)
                ->setYPosition(268)
                ->setLocked(true)
                ->setValue($data);
        }
        
        public function loadDefaults() {
            $this->signature();
            $this->fullName();
            $this->dateSigned();
        }
        
        protected function signature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature")
                ->setXPosition(73)
                ->setYPosition(605);
        }
        
        protected function fullName() {
            $this->new('full_name_tabs')
                ->setTabLabel("{$this->config['name']}-full-name")
                ->setXPosition(80)
                ->setYPosition(664);
        }
        
        protected function dateSigned() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed")
                ->setXPosition(234)
                ->setYPosition(664);
        }
    }
