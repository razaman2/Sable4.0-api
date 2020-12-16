<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use App\Helpers\ApiBuilder\BaseEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\PropertyTypeEnum;

    class PropertyType extends BaseEnum
    {
        public function townhouse() {
            $this->data(PropertyTypeEnum::VALUE_TOWNHOUSE);
        }
        
        public function condo() {
            $this->data(PropertyTypeEnum::VALUE_CONDO);
        }
        
        public function business() {
            $this->data(PropertyTypeEnum::VALUE_BUSINESS);
        }
        
        public function singleFamilyHouse() {
            $this->data(PropertyTypeEnum::VALUE_SINGLE_FAMILY_HOUSE);
        }
    
        public function notSet() {
            $this->data(PropertyTypeEnum::VALUE_NOT_SET);
        }
    
        public function default() {
            $this->notSet();
        }
    }
