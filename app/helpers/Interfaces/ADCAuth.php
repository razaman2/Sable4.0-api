<?php
    
    namespace Helpers\Interfaces;
    
    interface ADCAuth extends Authenticateable
    {
        public function branchID();
        public function username();
        public function password();
        public function twoFactor();
    }
