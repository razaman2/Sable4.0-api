<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\Exceptions\InvalidTabException;
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;
    use Carbon\Carbon;

    class ServiceAgreement extends TemplateTabs implements Defaultable {
        
        public function config($properties = []) {
            return parent::config(array_merge($properties, ['name' => 'agreement']));
        }
    
        protected function agreementDate($data) {
            $date = explode(' ', Carbon::parse($data)->isoFormat('MMMM Do YY'));
            if(count($date) !== 3) {
                throw new InvalidTabException('invalid agreement date provided!');
            }
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-date-day")
                ->setXPosition(200)
                ->setYPosition(80)
                ->setLocked(true)
                ->setValue($date[1]);
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-date-month")
                ->setXPosition(275)
                ->setYPosition(80)
                ->setLocked(true)
                ->setValue($date[0]);
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-date-year")
                ->setXPosition(360)
                ->setYPosition(80)
                ->setLocked(true)
                ->setValue($date[2]);
        }
        
        protected function subscriberName($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-subscriber-name")
                ->setXPosition(112)
                ->setYPosition(103)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function address($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-address")
                ->setXPosition(100)
                ->setYPosition(118)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function city($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-city")
                ->setXPosition(325)
                ->setYPosition(118)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function state($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-state")
                ->setXPosition(440)
                ->setYPosition(118)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function zip($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-zip")
                ->setXPosition(483)
                ->setYPosition(118)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function serviceBegins($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-payable1")
                // ->setAnchorString('monitoring service begins (')
                ->setXPosition(535)
                ->setYPosition(566)
                // ->setAnchorXOffset(410)
                // ->setAnchorYOffset(600)
                // ->setAnchorIgnoreIfNotPresent(false)
                // ->setAnchorUnits('pixels')
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function homePhone($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-home-phone")
                ->setXPosition(112)
                ->setYPosition(131)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function businessPhone($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-business-phone")
                ->setXPosition(262)
                ->setYPosition(131)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function email($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-email")
                ->setXPosition(383)
                ->setYPosition(131)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function billingAddress($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-billing-address")
                ->setXPosition(122)
                ->setYPosition(144)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function systemType(array $data) {
            // Takeover CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type-takeover")
                ->setXPosition(147)
                ->setYPosition(189)
                ->setLocked(true)
                ->setSelected(in_array('takeover', $data));
        
            // Valley Installed System CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type2")
                ->setXPosition(271)
                ->setYPosition(189)
                ->setLocked(true)
                ->setSelected(in_array(2, $data));
        
            // install additional equipment CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type3")
                ->setXPosition(357)
                ->setYPosition(189)
                ->setLocked(true)
                ->setSelected(in_array(3, $data));
        
            // UNSURE WHAT MONITORING LINKS TO ?????
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type-monitoring")
                ->setXPosition(272)
                ->setYPosition(198)
                ->setLocked(true)
                ->setSelected(in_array('monitoring', $data));
        
            // Contract Repair Service CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type5")
                ->setXPosition(183)
                ->setYPosition(198)
                ->setLocked(true)
                ->setSelected(in_array('contractRepairService', $data));
        
            // Time and equipment CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type6")
                ->setXPosition(272)
                ->setYPosition(198)
                ->setLocked(true)
                ->setSelected(in_array(6, $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type7")
                ->setXPosition(426)
                ->setYPosition(295)
                ->setLocked(true)
                ->setSelected(in_array(7, $data));
        }
    
        protected function serviceType(array $data) {
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-service-type-landline")
                ->setXPosition(129)
                ->setYPosition(338)
                ->setLocked(true)
                ->setSelected(in_array('landline', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-service-type-cell")
                ->setXPosition(272)
                ->setYPosition(198)
                ->setLocked(true)
                ->setSelected(in_array('cell', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-service-type-radio")
                ->setXPosition(388)
                ->setYPosition(339)
                ->setLocked(true)
                ->setSelected(in_array('radio', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-service-type-internet")
                ->setXPosition(418)
                ->setYPosition(339)
                ->setLocked(true)
                ->setSelected(in_array('internet', $data));
        }
    
        protected function equipment($data) {
            $equipments = array_slice($data, 0, 50);
            $positionX = ['qty' => 83, 'description' => 105];
            $positionY = 280;
            array_walk($equipments, function($equipment, $index) use (&$positionX, &$positionY) {
                if($index > 24) {
                    $positionX = ['qty' => 302, 'description' => 324];
                }
                if($index == 25) {
                    $positionY = 280;
                }
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-item{$index}-qty")
                    ->setXPosition($positionX['qty'])
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue($equipment['quantity']);
            
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-item{$index}-name")
                    ->setXPosition($positionX['description'])
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue(substr($equipment['name'], 0, 35));
                $positionY += 9;
            });
        }
        
        protected function term($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-payable")
                ->setAnchorString('per month, payable')
                ->setAnchorXOffset(56)
                ->setAnchorYOffset(-3)
                ->setAnchorIgnoreIfNotPresent(false)
                ->setAnchorUnits('pixels')
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function electronicPayment($data) {
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-electronic-payment")
                ->setAnchorString('ACH/EFT PAYMENT:')
                ->setAnchorXOffset(-69)
                ->setAnchorYOffset(-4)
                ->setAnchorIgnoreIfNotPresent(false)
                ->setAnchorUnits('pixels')
                ->setLocked(true)
                ->setSelected($data);
        }
    
        protected function installationStart($data) {
            $date = explode(' ', Carbon::parse($data)->isoFormat('MMMM Do YY'));
            if(count($date) !== 3) {
                throw new InvalidTabException('invalid installation start date!');
            }
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-installation-start-date")
                ->setXPosition(180)
                ->setYPosition(256)
                ->setLocked(true)
                ->setValue("{$date[0]} {$date[1]}");
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-installation-start-year")
                ->setXPosition(280)
                ->setYPosition(256)
                ->setLocked(true)
                ->setValue($date[2]);
        }
    
        protected function installationEnd($data) {
            $date = explode(' ', Carbon::parse($data)->isoFormat('MMMM Do YY'));
            if(count($date) !== 3) {
                throw new InvalidTabException('invalid installation end date!');
            }
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-installation-end-date")
                ->setXPosition(382)
                ->setYPosition(256)
                ->setLocked(true)
                ->setValue("{$date[0]} {$date[1]}");
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-installation-end-year")
                ->setXPosition(486)
                ->setYPosition(256)
                ->setLocked(true)
                ->setValue($date[2]);
        }
    
        protected function rmr($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-rmr")
                ->setXPosition(126)
                ->setYPosition(564)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function installFee($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-install-fee")
                ->setAnchorString('SALE, INSTALLATION PRICE.')
                ->setAnchorXOffset(294)
                ->setAnchorYOffset(-1)
                ->setAnchorIgnoreIfNotPresent(false)
                ->setAnchorUnits('pixels')
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function serviceFee($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-service-fee")
                ->setXPosition(398)
                ->setYPosition(558)
                ->setLocked(true)
                ->setValue($data);
        }
    
        public function loadDefaults() {
            $this->initial();
        }
    
        protected function initial() {
            $this->new('initial_here_tabs')
                ->setTabLabel("{$this->config['name']}-initial")
                ->setConditionalParentLabel("{$this->config['name']}-electronic-payment")
                ->setConditionalParentValue('on')
                ->setXPosition(122)
                ->setYPosition(570);
        }
    }
