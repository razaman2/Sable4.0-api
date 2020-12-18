<?php
    
    namespace App\Helpers\ADC\Enums;
    
    class SablePropertyTypeOverrides extends PropertyType
    {
        public function commercial() {
            $this->business();
        }
        
        public function residential() {
            $this->singleFamilyHouse();
        }
    }