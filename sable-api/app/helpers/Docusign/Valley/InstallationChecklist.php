<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;

    class InstallationChecklist extends TemplateTabs implements Defaultable
    {
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'checklist']));
        }
    
        public function loadDefaults() {
            $this->initial();
            $this->checkbox1();
            $this->checkbox2();
            $this->checkbox3();
        }
        
        public function subscriberName($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-name")
                ->setXPosition(409)
                ->setYPosition(746)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function initial() {
            $this->new('initial_here_tabs')
                ->setTabLabel("{$this->config['name']}-initial")
                ->setXPosition(533)
                ->setYPosition(376)
                ->setOptional(true);
        }
        
        public function checkbox1() {
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-checkbox1")
                ->setXPosition(87)
                ->setYPosition(238)
                ->setSelected(false);
        }
        
        public function checkbox2() {
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-checkbox2")
                ->setXPosition(87)
                ->setYPosition(288)
                ->setSelected(false);
        }
        
        public function checkbox3() {
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-checkbox3")
                ->setXPosition(87)
                ->setYPosition(341)
                ->setSelected(false);
        }
    }
