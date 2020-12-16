<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use App\Helpers\ApiBuilder\BaseEnum;

    class Package extends BaseEnum
    {
        public function ResidentialBasicInteractive() {
            $this->data(2);
        }
        
        public function CommercialBasicInteractive() {
            $this->data(0);
        }
        
        public function ResidentialAdvancedInteractive() {
            $this->data(0);
        }
        
        public function CommercialAdvancedInteractive() {
            $this->data(0);
        }
        
        public function HomeCenterBasicWeather() {
            $this->data(0);
        }
        
        public function InteractiveGold() {
            $this->data(193);
        }
        
        public function InteractiveSecurityAutomation() {
            $this->data(209);
        }
        
        public function InteractiveSecurity() {
            $this->data(208);
        }
        
        public function WirelessSignalForwarding() {
            $this->data(1);
        }
        
        public function Commercial() {
            $this->data(41);
        }
        
        public function CommercialPlus() {
            $this->data(42);
        }
    
        public function None() {
            $this->data(0);
        }
    
        public function default() {
            $this->None();
        }
    }