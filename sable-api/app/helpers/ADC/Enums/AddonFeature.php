<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use Wsdl\ADC\CustomerManagement\EnumType\AddOnFeatureEnum;

    class AddonFeature extends ADCEnum
    {
        public function VoiceNotificationsForAlarms() {
            $this->data(AddOnFeatureEnum::VALUE_VOICE_NOTIFICATIONS_FOR_ALARMS, 0);
        }
        
        public function VoiceNotificationsForMonitoring() {
            $this->data(AddOnFeatureEnum::VALUE_VOICE_NOTIFICATIONS_FOR_MONITORING, 1);
        }
        
        public function LightAutomation() {
            $this->data(AddOnFeatureEnum::VALUE_LIGHT_AUTOMATION, 2);
        }
        
        public function UserCodeControl() {
            $this->data(AddOnFeatureEnum::VALUE_USER_CODE_CONTROL, 3);
        }
        
        public function RemoteArming() {
            $this->data(AddOnFeatureEnum::VALUE_REMOTE_ARMING, 4);
        }
        
        public function ThermostatControl() {
            $this->data(AddOnFeatureEnum::VALUE_THERMOSTAT_CONTROL, 5);
        }
        
        public function ArmingSupervision() {
            $this->data(AddOnFeatureEnum::VALUE_ARMING_SUPERVISION, 6);
        }
        
        public function NormalActivityReports() {
            $this->data(AddOnFeatureEnum::VALUE_NORMAL_ACTIVITY_REPORTS, 7);
        }
        
        public function ArmingReports() {
            $this->data(AddOnFeatureEnum::VALUE_ARMING_REPORTS, 8);
        }
        
        public function ArmingSchedules() {
            $this->data(AddOnFeatureEnum::VALUE_ARMING_SCHEDULES, 9);
        }
        
        public function Inactivity() {
            $this->data(AddOnFeatureEnum::VALUE_INACTIVITY, 10);
        }
        
        public function FiveNormalActivitySensors() {
            $this->data(AddOnFeatureEnum::VALUE_FIVE_NORMAL_ACTIVITY_SENSORS, 11);
        }
        
        public function ProVideo() {
            $this->data(AddOnFeatureEnum::VALUE_PRO_VIDEO, 12);
        }
        
        public function ProVideoPlus() {
            $this->data(AddOnFeatureEnum::VALUE_PRO_VIDEO_PLUS, 13);
        }
        
        public function TwoFiftyMBExtraVideoStorage() {
            $this->data(AddOnFeatureEnum::VALUE_TWO_FIFTY_MBEXTRA_VIDEO_STORAGE, 14);
        }
        
        public function TwoWayVoice() {
            $this->data(AddOnFeatureEnum::VALUE_TWO_WAY_VOICE, 15);
        }
        
        public function WeatherToPanel() {
            $this->data(AddOnFeatureEnum::VALUE_WEATHER_TO_PANEL, 16);
        }
        
        public function DigitalInputVideos() {
            $this->data(AddOnFeatureEnum::VALUE_DIGITAL_INPUT_VIDEOS, 17);
        }
        
        public function MedicationAlerts() {
            $this->data(AddOnFeatureEnum::VALUE_MEDICATION_ALERTS, 18);
        }
        
        public function ZWaveLights() {
            $this->data(AddOnFeatureEnum::VALUE_ZWAVE_LIGHTS, 19);
        }
        
        public function ZWaveThermostats() {
            $this->data(AddOnFeatureEnum::VALUE_ZWAVE_THERMOSTATS, 20);
        }
        
        public function ZWaveLocks() {
            $this->data(AddOnFeatureEnum::VALUE_ZWAVE_LOCKS, 21);
        }
        
        public function EnterpriseNotices() {
            $this->data(AddOnFeatureEnum::VALUE_ENTERPRISE_NOTICES, 22);
        }
        
        public function ZWaveEnergy() {
            $this->data(AddOnFeatureEnum::VALUE_ZWAVE_ENERGY, 23);
        }
        
        public function Reminders() {
            $this->data(AddOnFeatureEnum::VALUE_REMINDERS, 24);
        }
        
        public function SevereWeatherAlerts() {
            $this->data(AddOnFeatureEnum::VALUE_SEVERE_WEATHER_ALERTS, 25);
        }
        
        public function ImageSensorAlarms() {
            $this->data(AddOnFeatureEnum::VALUE_IMAGE_SENSOR_ALARMS, 26);
        }
        
        public function ImageSensorPlus() {
            $this->data(AddOnFeatureEnum::VALUE_IMAGE_SENSOR_PLUS, 27);
        }
        
        public function ImageSensorExtraUploads() {
            $this->data(AddOnFeatureEnum::VALUE_IMAGE_SENSOR_EXTRA_UPLOADS, 28);
        }
        
        public function EnterpriseSecurityConsole() {
            $this->data(AddOnFeatureEnum::VALUE_ENTERPRISE_SECURITY_CONSOLE, 29);
        }
        
        public function SmartEnergyPlus() {
            $this->data(AddOnFeatureEnum::VALUE_SMART_ENERGY_PLUS, 30);
        }
        
        public function Securus() {
            $this->data(AddOnFeatureEnum::VALUE_SECURUS, 31);
        }
        
        public function LutronRemoteAccess() {
            $this->data(AddOnFeatureEnum::VALUE_LUTRON_REMOTE_ACCESS, 32);
        }
        
        public function IDProtection() {
            $this->data(AddOnFeatureEnum::VALUE_IDPROTECTION, 33);
        }
        
        public function GreenButton() {
            $this->data(AddOnFeatureEnum::VALUE_GREEN_BUTTON, 34);
        }
        
        public function LutronIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_LUTRON_INTEGRATION, 35);
        }
        
        public function AdvancedAutomation() {
            $this->data(AddOnFeatureEnum::VALUE_ADVANCED_AUTOMATION, 36);
        }
        
        public function TaggIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_TAGG_INTEGRATION, 37);
        }
        
        public function WaterManagement() {
            $this->data(AddOnFeatureEnum::VALUE_WATER_MANAGEMENT, 38);
        }
        
        public function GarageDoors() {
            $this->data(AddOnFeatureEnum::VALUE_GARAGE_DOORS, 39);
        }
        
        public function Wellness() {
            $this->data(AddOnFeatureEnum::VALUE_WELLNESS, 40);
        }
        
        public function ObsoleteLutronLightsAndThermostats() {
            $this->data(AddOnFeatureEnum::VALUE_OBSOLETE_LUTRON_LIGHTS_AND_THERMOSTATS, 41);
        }
        
        public function AdvancedEnergy() {
            $this->data(AddOnFeatureEnum::VALUE_ADVANCED_ENERGY, 42);
        }
        
        public function LiftMasterIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_LIFT_MASTER_INTEGRATION, 43);
        }
        
        public function SchneiderIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_SCHNEIDER_INTEGRATION, 44);
        }
        
        public function Video24x7PerSVR() {
            $this->data(AddOnFeatureEnum::VALUE_VIDEO_24_X_7_PER_SVR, 45);
        }
        
        public function CommercialActivityReports() {
            $this->data(AddOnFeatureEnum::VALUE_COMMERCIAL_ACTIVITY_REPORTS, 46);
        }
        
        public function BeCloseCommunityView() {
            $this->data(AddOnFeatureEnum::VALUE_BE_CLOSE_COMMUNITY_VIEW, 47);
        }
        
        public function ULCommericial() {
            $this->data(AddOnFeatureEnum::VALUE_ULCOMMERICIAL, 48);
        }
        
        public function SolarMonitoring() {
            $this->data(AddOnFeatureEnum::VALUE_SOLAR_MONITORING, 49);
        }
        
        public function SolarEdgeIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_SOLAR_EDGE_INTEGRATION, 50);
        }
        
        public function EnphaseIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_ENPHASE_INTEGRATION, 51);
        }
        
        public function NESTIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_NESTINTEGRATION, 52);
        }
        
        public function SMSAlarms() {
            $this->data(AddOnFeatureEnum::VALUE_SMSALARMS, 53);
        }
        
        public function SMSNotificationsMexico() {
            $this->data(AddOnFeatureEnum::VALUE_SMSNOTIFICATIONS_MEXICO, 54);
        }
        
        public function EnterpriseEnergy() {
            $this->data(AddOnFeatureEnum::VALUE_ENTERPRISE_ENERGY, 55);
        }
        
        public function EnterpriseWellness() {
            $this->data(AddOnFeatureEnum::VALUE_ENTERPRISE_WELLNESS, 56);
        }
        
        public function IrrigationControl() {
            $this->data(AddOnFeatureEnum::VALUE_IRRIGATION_CONTROL, 57);
        }
        
        public function RachioIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_RACHIO_INTEGRATION, 58);
        }
        
        public function ConnectedCar() {
            $this->data(AddOnFeatureEnum::VALUE_CONNECTED_CAR, 59);
        }
        
        public function PropaneMonitoring() {
            $this->data(AddOnFeatureEnum::VALUE_PROPANE_MONITORING, 60);
        }
        
        public function SMSNotificationsChile() {
            $this->data(AddOnFeatureEnum::VALUE_SMSNOTIFICATIONS_CHILE, 61);
        }
        
        public function SMSNotificationsColombia() {
            $this->data(AddOnFeatureEnum::VALUE_SMSNOTIFICATIONS_COLOMBIA, 62);
        }
        
        public function SMSNotificationsNZ() {
            $this->data(AddOnFeatureEnum::VALUE_SMSNOTIFICATIONS_NZ, 63);
        }
        
        public function SMSNotificationsAustralia() {
            $this->data(AddOnFeatureEnum::VALUE_SMSNOTIFICATIONS_AUSTRALIA, 64);
        }
        
        public function SMSNotificationsBrazil() {
            $this->data(AddOnFeatureEnum::VALUE_SMSNOTIFICATIONS_BRAZIL, 65);
        }
        
        public function SMSNotificationsPanama() {
            $this->data(AddOnFeatureEnum::VALUE_SMSNOTIFICATIONS_PANAMA, 66);
        }
        
        public function CosaIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_COSA_INTEGRATION, 67);
        }
        
        public function OSnappIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_OSNAPP_INTEGRATION, 68);
        }
        
        public function ConnectedCarPlus() {
            $this->data(AddOnFeatureEnum::VALUE_CONNECTED_CAR_PLUS, 69);
        }
        
        public function DoorbellCameras() {
            $this->data(AddOnFeatureEnum::VALUE_DOORBELL_CAMERAS, 70);
        }
        
        public function BasicDoorbell() {
            $this->data(AddOnFeatureEnum::VALUE_BASIC_DOORBELL, 71);
        }
        
        public function UnexpectedActivityAlerts() {
            $this->data(AddOnFeatureEnum::VALUE_UNEXPECTED_ACTIVITY_ALERTS, 72);
        }
        
        public function AccessControl() {
            $this->data(AddOnFeatureEnum::VALUE_ACCESS_CONTROL, 73);
        }
        
        public function ZWaveCO() {
            $this->data(AddOnFeatureEnum::VALUE_ZWAVE_CO, 74);
        }
        
        public function HourlySupervision() {
            $this->data(AddOnFeatureEnum::VALUE_HOURLY_SUPERVISION, 75);
        }
        
        public function SixHourSupervision() {
            $this->data(AddOnFeatureEnum::VALUE_SIX_HOUR_SUPERVISION, 76);
        }
        
        public function AlarmVisualVerification() {
            $this->data(AddOnFeatureEnum::VALUE_ALARM_VISUAL_VERIFICATION, 77);
        }
        
        public function PanicButton() {
            $this->data(AddOnFeatureEnum::VALUE_PANIC_BUTTON, 78);
        }
        
        public function AudioIntegration() {
            $this->data(AddOnFeatureEnum::VALUE_AUDIO_INTEGRATION, 79);
        }
        
        public function KonaLabsWaterMetering() {
            $this->data(AddOnFeatureEnum::VALUE_KONA_LABS_WATER_METERING, 80);
        }
        
        public function VideoDeviceAudio() {
            $this->data(AddOnFeatureEnum::VALUE_VIDEO_DEVICE_AUDIO, 81);
        }
        
        public function CancelVerify() {
            $this->data(AddOnFeatureEnum::VALUE_CANCEL_VERIFY, 82);
        }
        
        public function SMSNotificationsBelgium() {
            $this->data(AddOnFeatureEnum::VALUE_SMSNOTIFICATIONS_BELGIUM, 83);
        }
        
        public function AccessControlDoors() {
            $this->data(AddOnFeatureEnum::VALUE_ACCESS_CONTROL_DOORS, 84);
        }
        
        public function RouterLimits() {
            $this->data(AddOnFeatureEnum::VALUE_ROUTER_LIMITS, 85);
        }
    }
