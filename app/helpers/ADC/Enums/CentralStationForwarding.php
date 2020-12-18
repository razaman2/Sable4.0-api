<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use App\Helpers\ApiBuilder\BaseEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\CentralStationForwardingOptionEnum;

    class CentralStationForwarding extends BaseEnum
    {
        public function Never() {
            $this->data(CentralStationForwardingOptionEnum::VALUE_NEVER);
        }
    
        public function Always() {
            $this->data(CentralStationForwardingOptionEnum::VALUE_ALWAYS);
        }
    
        public function OnlyIfPhoneFails() {
            $this->data(CentralStationForwardingOptionEnum::VALUE_ONLY_IF_PHONE_FAILS);
        }
    
        public function default() {
            $this->NotSet();
        }
    
        public function NotSet() {
            $this->data(CentralStationForwardingOptionEnum::VALUE_NOT_SET);
        }
    }