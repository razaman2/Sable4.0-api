<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use Carbon\Carbon;

    class ServiceAgreementRMR extends ServiceAgreement {
        
        protected function agreementDate($data) {
            $date = explode(' ', Carbon::parse($data)->isoFormat('MMMM Do YY'));
            if(count($date) !== 3) {
                throw new InvalidTabException('invalid agreement date provided!');
            }
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-date-day")
                ->setXPosition(200)
                ->setYPosition(70)
                ->setLocked(true)
                ->setValue($date[1]);
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-date-month")
                ->setXPosition(275)
                ->setYPosition(70)
                ->setLocked(true)
                ->setValue($date[0]);
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-date-year")
                ->setXPosition(360)
                ->setYPosition(70)
                ->setLocked(true)
                ->setValue($date[2]);
        }

        protected function subscriberName($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-subscriber-name")
                ->setXPosition(112)
                ->setYPosition(95)
                ->setLocked(true)
                ->setValue($data);
        }

        protected function address($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-address")
                ->setXPosition(100)
                ->setYPosition(108)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function city($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-city")
                ->setXPosition(325)
                ->setYPosition(108)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function state($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-state")
                ->setXPosition(440)
                ->setYPosition(108)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function zip($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-zip")
                ->setXPosition(483)
                ->setYPosition(108)
                ->setLocked(true)
                ->setValue($data);
        }

        protected function serviceBegins($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-payable1")
                // ->setAnchorString('monitoring service begins (')
                ->setXPosition(495)
                ->setYPosition(564)
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
                ->setYPosition(121)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function businessPhone($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-business-phone")
                ->setXPosition(262)
                ->setYPosition(121)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function email($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-email")
                ->setXPosition(383)
                ->setYPosition(121)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function billingAddress($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-billing-address")
                ->setXPosition(122)
                ->setYPosition(134)
                ->setLocked(true)
                ->setValue($data);
        }

        protected function systemType(array $data) {
            // Takeover CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type-takeover")
                ->setXPosition(147)
                ->setYPosition(179)
                ->setLocked(true)
                ->setSelected(in_array('takeover', $data));
    
                // Valley Installed System CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type2")
                ->setXPosition(270)
                ->setYPosition(179)
                ->setLocked(true)
                ->setSelected(in_array(2, $data));
    
                // install additional equipment CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type3")
                ->setXPosition(358)
                ->setYPosition(179)
                ->setLocked(true)
                ->setSelected(in_array(3, $data));
    
                // UNSURE WHAT MONITORING LINKS CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type-monitoring")
                ->setXPosition(131)
                ->setYPosition(188)
                ->setLocked(true)
                ->setSelected(in_array('monitoring', $data));
    
                // Contract Repair Service CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type5")
                ->setXPosition(183)
                ->setYPosition(188)
                ->setLocked(true)
                ->setSelected(in_array('contractRepairService', $data));
    
                    // Time and equipment CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type6")
                ->setXPosition(272)
                ->setYPosition(188)
                ->setLocked(true)
                ->setSelected(in_array(6, $data));
                
                // Alarm Response Equipment CORRECT
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}system-type7")
                ->setXPosition(387)
                ->setYPosition(188)
                ->setLocked(true)
                ->setSelected(in_array(7, $data));
        }

        protected function serviceType(array $data) {
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-service-type-landline")
                ->setXPosition(130)
                ->setYPosition(216)
                ->setLocked(true)
                ->setSelected(in_array('landline', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-service-type-cell")
                ->setXPosition(205)
                ->setYPosition(216)
                ->setLocked(true)
                ->setSelected(in_array('cell', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-service-type-radio")
                ->setXPosition(297)
                ->setYPosition(216)
                ->setLocked(true)
                ->setSelected(in_array('radio', $data));
        
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-service-type-internet")
                ->setXPosition(381)
                ->setYPosition(216)
                ->setLocked(true)
                ->setSelected(in_array('internet', $data));
        }

        protected function equipment($data) {
            $equipments = array_slice($data, 0, 50);
            $positionX = ['qty' => 83, 'description' => 105];
            $positionY = 293;
            array_walk($equipments, function($equipment, $index) use (&$positionX, &$positionY) {
                if($index > 24) {
                    $positionX = ['qty' => 302, 'description' => 324];
                }
                if($index == 25) {
                    $positionY = 293;
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
    }
