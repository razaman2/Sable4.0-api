<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use Wsdl\ADC\CustomerManagement\EnumType\CustomerNotificationEnum;

    class CustomerNotification extends ADCEnum
    {
        public function LockCannotBeSecured() {
            $this->data(CustomerNotificationEnum::VALUE_LOCK_CANNOT_BE_SECURED, 0);
        }
    
        public function Alarms() {
            $this->data(CustomerNotificationEnum::VALUE_ALARMS, 1);
        }
    
        public function Arming() {
            $this->data(CustomerNotificationEnum::VALUE_ARMING, 2);
        }
    
        public function Disarming() {
            $this->data(CustomerNotificationEnum::VALUE_DISARMING, 3);
        }
    
        public function PowerFailure() {
            $this->data(CustomerNotificationEnum::VALUE_POWER_FAILURE, 4);
        }
    
        public function PowerRestored() {
            $this->data(CustomerNotificationEnum::VALUE_POWER_RESTORED, 5);
        }
    
        public function LowBattery() {
            $this->data(CustomerNotificationEnum::VALUE_LOW_BATTERY, 6);
        }
    
        public function Bypassed() {
            $this->data(CustomerNotificationEnum::VALUE_BYPASSED, 7);
        }
    
        public function Tamper() {
            $this->data(CustomerNotificationEnum::VALUE_TAMPER, 8);
        }
    
        public function Malfunction() {
            $this->data(CustomerNotificationEnum::VALUE_MALFUNCTION, 9);
        }
    
        public function CameraNotResponding() {
            $this->data(CustomerNotificationEnum::VALUE_CAMERA_NOT_RESPONDING, 10);
        }
    
        public function CameraUploadLimits() {
            $this->data(CustomerNotificationEnum::VALUE_CAMERA_UPLOAD_LIMITS, 11);
        }
    
        public function SmsOverQuota() {
            $this->data(CustomerNotificationEnum::VALUE_SMS_OVER_QUOTA, 12);
        }
    
        public function PanelNotResponding() {
            $this->data(CustomerNotificationEnum::VALUE_PANEL_NOT_RESPONDING, 13);
        }
    
        public function ArmingReminder() {
            $this->data(CustomerNotificationEnum::VALUE_ARMING_REMINDER, 14);
        }
    
        public function Insights() {
            $this->data(CustomerNotificationEnum::VALUE_INSIGHTS, 15);
        }
    
        public function TroubleSensorTriggered() {
            $this->data(CustomerNotificationEnum::VALUE_TROUBLE_SENSOR_TRIGGERED, 16);
        }
    
        public function HVACHealthReport() {
            $this->data(CustomerNotificationEnum::VALUE_HVACHEALTH_REPORT, 17);
        }
    
        public function SeasonalMaintenance() {
            $this->data(CustomerNotificationEnum::VALUE_SEASONAL_MAINTENANCE, 18);
        }
    
        public function COSensorOpened() {
            $this->data(CustomerNotificationEnum::VALUE_COSENSOR_OPENED, 19);
        }
    
        public function TemperatureSensorOpened() {
            $this->data(CustomerNotificationEnum::VALUE_TEMPERATURE_SENSOR_OPENED, 20);
        }
    
        public function SensorActivated() {
            $this->data(CustomerNotificationEnum::VALUE_SENSOR_ACTIVATED, 21);
        }
    
        public function HeatingCoolingAlert() {
            $this->data(CustomerNotificationEnum::VALUE_HEATING_COOLING_ALERT, 22);
        }
    
        public function LockKeypadDisabledTooManyTries() {
            $this->data(CustomerNotificationEnum::VALUE_LOCK_KEYPAD_DISABLED_TOO_MANY_TRIES, 23);
        }
    }
