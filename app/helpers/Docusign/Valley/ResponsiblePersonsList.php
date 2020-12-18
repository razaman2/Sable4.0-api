<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;

    class ResponsiblePersonsList extends TemplateTabs implements Defaultable
    {
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'responsible-persons']));
        }
        
        protected $city_state = [];
    
        public function loadDefaults() {
            $this->signature();
            $this->date();
            if(!empty($this->city_state)) {
                $this->city_state("{$this->city_state['city']} {$this->city_state['state']}");
            }
        }
        
        public function subscriberName($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-name")
                ->setXPosition(50)
                ->setYPosition(156)
                ->setLocked(true)
                ->setValue($data);
        }
        
        public function address($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-address")
                ->setXPosition(50)
                ->setYPosition(187)
                ->setLocked(true)
                ->setValue($data);
        }
        
        public function city_state($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-city-state")
                ->setXPosition(50)
                ->setYPosition(221)
                ->setLocked(true)
                ->setValue($data);
        }
        
        public function city($data) {
            $this->city_state['city'] = $data;
        }
        
        public function state($data) {
            $this->city_state['state'] = $data;
        }
    
        public function phone1($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-phone")
                ->setXPosition(328)
                ->setYPosition(156)
                ->setLocked(true)
                ->setValue($data);
        }
    
        public function passcode($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-abort-code")
                ->setXPosition(328)
                ->setYPosition(187)
                ->setLocked(true)
                ->setValue($data);
        }
        
        public function contacts(array $contacts) {
            $positionY = 315;
            $contacts1 = array_splice($contacts, 0, 4);
            array_walk($contacts1, function($contact, $index) use (&$positionY) {
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-contact-name{$index}")
                    ->setXPosition(50)
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue("{$contact['firstName']} {$contact['lastName']}");
    
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-contact-phone{$index}")
                    ->setXPosition(328)
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue($contact['phone']);
                $positionY += 65;
            });
        }
        
        public function signature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature")
                ->setXPosition(92)
                ->setYPosition(640);
        }
        
        public function date() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed")
                ->setXPosition(366)
                ->setYPosition(674);
        }
    }
