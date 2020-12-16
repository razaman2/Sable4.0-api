<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use App\Helpers\ApiBuilder\BaseEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\PanelTypeEnum;

    class PanelType extends BaseEnum
    {
        public function concord() {
            $this->data(PanelTypeEnum::VALUE_CONCORD);
        }
        
        public function simon() {
            $this->data(PanelTypeEnum::VALUE_SIMON);
        }
    
        public function nx() {
            $this->data(PanelTypeEnum::VALUE_NX);
        }
        
        public function greybox() {
            $this->data(PanelTypeEnum::VALUE_GREYBOX);
        }
        
        public function elkGuard() {
            $this->data(PanelTypeEnum::VALUE_ELK_GUARD);
        }
    
        public function goControl() {
            $this->data(PanelTypeEnum::VALUE_TWO_G);
        }
        
        public function touchlink() {
            $this->data(PanelTypeEnum::VALUE_TOUCHLINK);
        }
        
        public function pointHub() {
            $this->data(PanelTypeEnum::VALUE_POINT_HUB);
        }
    
        public function iqPanel() {
            $this->data(PanelTypeEnum::VALUE_IQPANEL);
        }
        
        public function building36() {
            $this->data(PanelTypeEnum::VALUE_BUILDING_36);
        }
        
        public function advisor() {
            $this->data(PanelTypeEnum::VALUE_ADVISOR);
        }
        
        public function impassa() {
            $this->data(PanelTypeEnum::VALUE_IMPASSA);
        }
        
        public function neo() {
            $this->data(PanelTypeEnum::VALUE_NEO);
        }
        
        public function goControl3() {
            $this->data(PanelTypeEnum::VALUE_GO_CONTROL_3);
        }
        
        public function nucleus() {
            $this->data(PanelTypeEnum::VALUE_NUCLEUS);
        }
    
        public function semVista() {
            $this->data(PanelTypeEnum::VALUE_SEMVISTA);
        }
    
        public function semPowerSeries() {
            $this->data(PanelTypeEnum::VALUE_SEMPOWER_SERIES);
        }
        
        public function hxGW() {
            $this->data(PanelTypeEnum::VALUE_HX_GW);
        }
    
        public function iqPanel2() {
            $this->data(PanelTypeEnum::VALUE_IQPANEL_2);
        }
        
        public function vario() {
            $this->data(PanelTypeEnum::VALUE_VARIO);
        }
        
        public function iotega() {
            $this->data(PanelTypeEnum::VALUE_IOTEGA);
        }
        
        public function oneLink() {
            $this->data(PanelTypeEnum::VALUE_ONE_LINK);
        }
    
        public function noPanel() {
            $this->data(PanelTypeEnum::VALUE_NO_PANEL);
        }
    
        public function notSet() {
            $this->data(PanelTypeEnum::VALUE_NOT_SET);
        }
    
        //public function command() {
        //    $this->value = "Command";
        //}
        //
        //public function catM1() {
        //    $this->value = "CatM1";
        //}
        
        public function default() {
            $this->notSet();
        }
    }