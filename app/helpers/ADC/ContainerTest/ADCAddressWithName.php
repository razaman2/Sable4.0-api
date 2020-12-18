<?php
    
    namespace App\Helpers\ADC\ContainerTest;
    
    use App\Helpers\ADC\Enums\SableCountryOverrides;
    use Wsdl\ADC\CustomerManagement\StructType\AddressWithName;
    
    class ADCAddressWithName extends AddressWithName
    {
        public function address1($data) {
            $this->setStreet1($data);
        }
        
        public function address2($data) {
            $this->setStreet2($data);
        }
        
        public function country(SableCountryOverrides $data) {
            $this->setCountryId($data->select());
        }
    }
