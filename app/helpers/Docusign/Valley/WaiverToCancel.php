<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;

    class WaiverToCancel extends TemplateTabs implements Defaultable
    {
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'waiver']));
        }
        
        public function loadDefaults() {
            $this->notes();
            $this->signature1();
            $this->signature2();
            $this->dateSigned1();
            $this->dateSigned2();
        }
        
        public function notes() {
            return $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-note")
                ->setRequired(false)
                ->setHeight(150)
                ->setWidth(490)
                ->setXPosition(88)
                ->setYPosition(390);
        }
        
        protected function signature1() {
            return $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature1")
                ->setOptional(true)
                ->setXPosition(95)
                ->setYPosition(593);
        }
        
        protected function signature2() {
            return $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature2")
                ->setOptional(true)
                ->setXPosition(336)
                ->setYPosition(593);
        }
        
        protected function dateSigned1() {
            return $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed1")
                ->setXPosition(99)
                ->setYPosition(671);
        }
        
        protected function dateSigned2() {
            return $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed2")
                ->setXPosition(343)
                ->setYPosition(671);
        }
    }
