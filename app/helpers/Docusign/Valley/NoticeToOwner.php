<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;

    class NoticeToOwner extends TemplateTabs implements Defaultable
    {
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'notice-to-owner']));
        }
        
        public function loadDefaults() {
            $this->signature();
            $this->dateSigned();
        }
    
        public function subscriberName($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-name")
                ->setXPosition(125)
                ->setYPosition(722)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function signature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature1")
                ->setXPosition(140)
                ->setYPosition(642);
        }
        
        protected function dateSigned() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed")
                ->setXPosition(257)
                ->setYPosition(647);
        }
    }
