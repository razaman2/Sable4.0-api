<?php
    
    namespace App\Helpers\ADC\ContainerTest;
    
    use App\Helpers\ApiBuilder\Container;
    
    class ADCDesiredLogin
    {
        protected $firstName, $lastName, $accountId;
        
        public function firstName($data) {
            $this->firstName = $data;
        }
        
        public function lastName($data) {
            $this->lastName = $data;
        }
        
        public function accountId($data) {
            $this->accountId = $data;
        }
        
        public function contact($data) {
            (new Container($this))->build($data);
        }
        
        public function value() {
            return implode('', array_map(function($item) {
                    return substr($item, 0, 1);
                }, [
                    $this->firstName,
                    $this->lastName
                ])).substr($this->accountId, 0, 6);
        }
    }
