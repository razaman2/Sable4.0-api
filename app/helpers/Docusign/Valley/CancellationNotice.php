<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;
    use Carbon\Carbon;

    class CancellationNotice extends TemplateTabs implements Defaultable
    {
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'cancellation']));
        }
    
        public function loadDefaults() {
            $this->transactionDate();
            $this->latestCancellationDate();
            $this->dateSigned('07/18/19');
            $this->signature();
        }
    
        protected function transactionDate() {
            $date = explode(' ', Carbon::parse()->isoFormat('MMMM Do YY'));
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-transaction-date")
                ->setXPosition(214)
                ->setYPosition(86)
                ->setLocked(true)
                ->setValue("{$date[0]} {$date[1]}");
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-transaction-year")
                ->setXPosition(380)
                ->setYPosition(86)
                ->setLocked(true)
                ->setValue($date[2]);
        }
        
        protected function latestCancellationDate() {
            $date = explode(' ', Carbon::parse()->addDays(3)->isoFormat('MMMM Do YY'));
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-latest-cancellation-date")
                ->setXPosition(275)
                ->setYPosition(377)
                ->setLocked(true)
                ->setValue("{$date[0]} {$date[1]}");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-latest-cancellation-year")
                ->setXPosition(390)
                ->setYPosition(377)
                ->setLocked(true)
                ->setValue($date[2]);
        }
        
        protected function dateSigned($data) {
            $date = explode(' ', Carbon::parse($data)->isoFormat('MMMM Do YY'));
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed-date")
                ->setXPosition(338)
                ->setYPosition(536)
                ->setLocked(true)
                ->setValue("{$date[0]} {$date[1]}");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-date-signed-year")
                ->setXPosition(460)
                ->setYPosition(536)
                ->setLocked(true)
                ->setValue($date[2]);
        }
        
        protected function signature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-signature")
                ->setXPosition(309)
                ->setYPosition(542);
        }
    }
