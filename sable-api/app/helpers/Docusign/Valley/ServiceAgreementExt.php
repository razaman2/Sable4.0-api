<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;

    class ServiceAgreementExt extends TemplateTabs implements Defaultable
    {
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'agreement_ext']));
        }
    
        public function loadDefaults() {
             $this->fullName();
             $this->dateSigned();
             $this->signature1();
        }
    
        protected function fullName() {
            $this->new('full_name_tabs')
                ->setTabLabel("{$this->config['name']}-full-name")
                ->setXPosition(370)
                ->setYPosition(117);
        }
    
        protected function dateSigned() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed")
                ->setXPosition(360)
                ->setYPosition(130);
        }
    
        protected function signature1() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature1")
                ->setXPosition(344)
                ->setYPosition(63);
        }
    
        protected function salesperson($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-salesperson")
                ->setXPosition(80)
                ->setYPosition(97)
                ->setLocked(true)
                ->setValue($data);
        }
        // protected function signature2() {
        //     $this->new('sign_here_tabs')
        //         ->setTabLabel("{$this->config['name']}-signature2")
        //         ->setOptional(true)
        //         ->setXPosition(344)
        //         ->setYPosition(63);
        // }
    }
