<?php
    
    namespace App\Helpers\ADC\Enums;
    
    class SableCountryOverrides extends Country
    {
        public function us() {
            $this->usa();
        }
        
        public function ca() {
            $this->canada();
        }
    }