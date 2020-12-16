<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use Wsdl\ADC\CustomerManagement\EnumType\CentralStationEventGroupEnum;

    class CentralStationEventGroup extends ADCEnum
    {
        //public function NotSet() {
        //    $this->data(CentralStationEventGroupEnum::VALUE_NOT_SET, 0);
        //}
        //
        //public function AllEvents() {
        //    $this->data(CentralStationEventGroupEnum::VALUE_ALL_EVENTS, 1);
        //}
        
        public function Alarms() {
            $this->data(CentralStationEventGroupEnum::VALUE_ALARMS, 2);
        }
        
        public function Panics() {
            $this->data(CentralStationEventGroupEnum::VALUE_PANICS, 3);
        }
        
        public function Cancels() {
            $this->data(CentralStationEventGroupEnum::VALUE_CANCELS, 4);
        }
        
        public function Troubles() {
            $this->data(CentralStationEventGroupEnum::VALUE_TROUBLES, 5);
        }
        
        public function Armings() {
            $this->data(CentralStationEventGroupEnum::VALUE_ARMINGS, 6);
        }
        
        public function Bypass() {
            $this->data(CentralStationEventGroupEnum::VALUE_BYPASS, 7);
        }
        
        public function PhoneCommFailure() {
            $this->data(CentralStationEventGroupEnum::VALUE_PHONE_COMM_FAILURE, 8);
        }
        
        public function TroubleRestorals() {
            $this->data(CentralStationEventGroupEnum::VALUE_TROUBLE_RESTORALS, 9);
        }
        
        public function Residential() {
            $this->data(CentralStationEventGroupEnum::VALUE_RESIDENTIAL, 10);
        }
        
        public function Commercial() {
            $this->data(CentralStationEventGroupEnum::VALUE_COMMERCIAL, 11);
        }
        
        public function VectorCustom() {
            $this->data(CentralStationEventGroupEnum::VALUE_VECTOR_CUSTOM, 12);
        }
        
        public function CrashAndSmash() {
            $this->data(CentralStationEventGroupEnum::VALUE_CRASH_AND_SMASH, 13);
        }
        
        public function SensorTests() {
            $this->data(CentralStationEventGroupEnum::VALUE_SENSOR_TESTS, 14);
        }
        
        public function EtlSettings() {
            $this->data(CentralStationEventGroupEnum::VALUE_ETL_SETTINGS, 15);
        }
        
        public function PhoneTests() {
            $this->data(CentralStationEventGroupEnum::VALUE_PHONE_TESTS, 16);
        }
        
        public function PanelNotResponding() {
            $this->data(CentralStationEventGroupEnum::VALUE_PANEL_NOT_RESPONDING, 17);
        }
        
        public function SensorTampers() {
            $this->data(CentralStationEventGroupEnum::VALUE_SENSOR_TAMPERS, 18);
        }
        
        public function RFReceiverJamming() {
            $this->data(CentralStationEventGroupEnum::VALUE_RFRECEIVER_JAMMING, 19);
        }
        
        public function CancelsWithoutRestorals() {
            $this->data(CentralStationEventGroupEnum::VALUE_CANCELS_WITHOUT_RESTORALS, 20);
        }
        
        public function VideoVerification() {
            $this->data(CentralStationEventGroupEnum::VALUE_VIDEO_VERIFICATION, 21);
        }
        
        public function PassThrough() {
            $this->data(CentralStationEventGroupEnum::VALUE_PASS_THROUGH, 22);
        }
        
        public function VisualVerificationFibro() {
            $this->data(CentralStationEventGroupEnum::VALUE_VISUAL_VERIFICATION_FIBRO, 23);
        }
        
        public function DualPathSupervision() {
            $this->data(CentralStationEventGroupEnum::VALUE_DUAL_PATH_SUPERVISION, 24);
        }
        
        public function CancelVerify() {
            $this->data(CentralStationEventGroupEnum::VALUE_CANCEL_VERIFY, 25);
        }
        
        public function OpeningAfterAlarm() {
            $this->data(CentralStationEventGroupEnum::VALUE_OPENING_AFTER_ALARM, 26);
        }
        
        public function BypassRestore() {
            $this->data(CentralStationEventGroupEnum::VALUE_BYPASS_RESTORE, 27);
        }
    }
