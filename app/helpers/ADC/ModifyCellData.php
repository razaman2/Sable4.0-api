<?php
    
    namespace App\Helpers\ADC;
    
    use Wsdl\ADC\CustomerManagement\ArrayType\ArrayOfAddOnFeatureEnum;
    use Wsdl\ADC\CustomerManagement\ArrayType\ArrayOfCentralStationEventGroupEnum;
    use Wsdl\ADC\CustomerManagement\ArrayType\ArrayOfCustomerNotificationEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\AddOnFeatureEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\CentralStationEventGroupEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\CountryEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\CustomerNotificationEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\PanelTypeEnum;
    use Wsdl\ADC\CustomerManagement\EnumType\PropertyTypeEnum;
    use Wsdl\ADC\CustomerManagement\StructType\CreateCustomerInput;

    class ModifyCellData
    {
        protected $activateCell;
    
        protected $customerData;
        
        public function __construct(CreateCustomerInput $activateCell, $customerData) {
            $this->activateCell = $activateCell;
            $this->customerData = $customerData;
        }
        
        public function setCountryEnum() {
            $validCountries = [
                "us" => CountryEnum::VALUE_USA,
                "ca" => CountryEnum::VALUE_CANADA
            ];
            return $validCountries[strtolower($this->customerData["property"]["country"])];
        }
        
        public function setDesiredLoginName() {
            $username = array_map(function($item) {
                return substr($item, 0, 1);
            }, [
                $this->customerData["primaryContact"]["firstName"],
                $this->customerData["primaryContact"]["lastName"]
            ]);
            return implode('', $username).substr($this->customerData["id"], 0, 6);
        }
        
        public function setPanelType() {
            $validPanels = [
                "go control" => PanelTypeEnum::VALUE_TWO_G,
                "go control 3" => PanelTypeEnum::VALUE_GO_CONTROL_3,
                "ge concord 4" => PanelTypeEnum::VALUE_CONCORD,
                "ge simon xti" => PanelTypeEnum::VALUE_GREYBOX,
                "ge simon xt" => PanelTypeEnum::VALUE_GREYBOX,
                "ge simon xti-5" => PanelTypeEnum::VALUE_GREYBOX,
                "dsc neo" => PanelTypeEnum::VALUE_NEO,
                "qolsys iq 1" => PanelTypeEnum::VALUE_IQPANEL,
                "qolsys iq 2" => PanelTypeEnum::VALUE_IQPANEL_2
            ];
            return $validPanels[strtolower($this->customerData["equipment"]["panelType"])];
        }
        
        public function setEventGroupsToForward() {
            $eventGroupsToForward = new ArrayOfCentralStationEventGroupEnum();
            $this->customerData["Events To Forward"] = "alarms;panics;cancels;troubles;armings;bypass;crash & smash;panel not responding;phone communication failures;sensor tampers;phone tests;trouble restorals";
            $eventGroups = explode(";", $this->customerData["Events To Forward"]);
            $validEventGroups = [
                "none" => CentralStationEventGroupEnum::VALUE_NOT_SET,
                "all events" => CentralStationEventGroupEnum::VALUE_ALL_EVENTS,
                "alarms" => CentralStationEventGroupEnum::VALUE_ALARMS,
                "panics" => CentralStationEventGroupEnum::VALUE_PANICS,
                "cancels" => CentralStationEventGroupEnum::VALUE_CANCELS,
                "troubles" => CentralStationEventGroupEnum::VALUE_TROUBLES,
                "armings" => CentralStationEventGroupEnum::VALUE_ARMINGS,
                "bypass" => CentralStationEventGroupEnum::VALUE_BYPASS,
                "phone communication failures" => CentralStationEventGroupEnum::VALUE_PHONE_COMM_FAILURE,
                "trouble restorals" => CentralStationEventGroupEnum::VALUE_TROUBLE_RESTORALS,
                "crash & smash" => CentralStationEventGroupEnum::VALUE_CRASH_AND_SMASH,
                "sensor tests" => CentralStationEventGroupEnum::VALUE_SENSOR_TESTS,
                "phone tests" => CentralStationEventGroupEnum::VALUE_PHONE_TESTS,
                "panel not responding" => CentralStationEventGroupEnum::VALUE_PANEL_NOT_RESPONDING,
                "sensor tampers" => CentralStationEventGroupEnum::VALUE_SENSOR_TAMPERS,
                "cancels without restorals" => CentralStationEventGroupEnum::VALUE_CANCELS_WITHOUT_RESTORALS,
                "cancel verify" => CentralStationEventGroupEnum::VALUE_CANCEL_VERIFY
            ];
            foreach($eventGroups as $eventGroup) {
                $eventGroupsToForward->addToCentralStationEventGroupEnum($validEventGroups[strtolower($eventGroup)]);
            }
            return $eventGroupsToForward;
        }
        
        public function setPhoneLinePresent() {
            $phoneLinePresent = false;
            if($this->customerData["equipment"]["panelPhone"] != null) {
                $phoneLinePresent = true;
            }
            return $phoneLinePresent;
        }
        
        public function setPackageId() {
            $validPackages = [
                "RESIDENTIAL BASIC INTERACTIVE" => 2,
                "COMMERCIAL BASIC INTERACTIVE" => 0,
                "RESIDENTIAL ADVANCED INTERACTIVE" => 0,
                "COMMERCIAL ADVANCED INTERACTIVE" => 0,
                "HOME CENTER BASIC WEATHER" => 0,
                "INTERACTIVE GOLD" => 193,
                "INTERACTIVE SECURITY + AUTOMATION" => 209,
                "INTERACTIVE SECURITY" => 208,
                "WIRELESS SIGNAL FORWARDING" => 1,
                "COMMERCIAL" => 41,
                "COMMERCIAL PLUS" => 42,
            ];
            return $validPackages[strtoupper($this->customerData["purchaseDetails"]["levelOfService"])];
        }
        
        public function setAddonFeatures() {
            $addonFeatures = new ArrayOfAddOnFeatureEnum();
            $this->customerData['packages'] = "severe weather alerts;weather to panel";
            $addons = explode(";", $this->customerData["packages"]);
            $validAddonFeatures = [
                //"wireless two-way voice" => AddOnFeatureEnum::VALUE_TWO_WAY_VOICE,
                //"lights and thermostats bundle" => "",
                "lights" => AddOnFeatureEnum::VALUE_ZWAVE_LIGHTS,
                "locks" => AddOnFeatureEnum::VALUE_ZWAVE_LOCKS,
                "thermostats" => AddOnFeatureEnum::VALUE_ZWAVE_THERMOSTATS,
                //"energy monitoring" => "",
                "lutron integration" => AddOnFeatureEnum::VALUE_LUTRON_INTEGRATION,
                "garage door control" => AddOnFeatureEnum::VALUE_GARAGE_DOORS,
                "liftmaster integration" => AddOnFeatureEnum::VALUE_LIFT_MASTER_INTEGRATION,
                "water management" => AddOnFeatureEnum::VALUE_WATER_MANAGEMENT,
                "irrigation control" => AddOnFeatureEnum::VALUE_IRRIGATION_CONTROL,
                "voice notifications for alarms" => AddOnFeatureEnum::VALUE_VOICE_NOTIFICATIONS_FOR_ALARMS,
                //"voice notifications for non-alarms" => "",
                "weather to panel" => AddOnFeatureEnum::VALUE_WEATHER_TO_PANEL,
                "severe weather alerts" => AddOnFeatureEnum::VALUE_SEVERE_WEATHER_ALERTS,
                //"identity theft protection" => "",
                //"schedule arm/disarm" => "",
                "enterprise notices" => AddOnFeatureEnum::VALUE_ENTERPRISE_NOTICES,
                "wellness" => AddOnFeatureEnum::VALUE_WELLNESS,
                "images" => AddOnFeatureEnum::VALUE_IMAGE_SENSOR_ALARMS
            ];
            foreach($addons as $key => $addon) {
                if(array_key_exists($addon, $validAddonFeatures)) {
                    $addonFeatures->addToAddOnFeatureEnum($validAddonFeatures[strtolower($addon)]);
                }
            }
            if($this->customerData["purchaseDetails"]["twoWayVoice"] === true) {
                $addonFeatures->addToAddOnFeatureEnum(AddOnFeatureEnum::VALUE_TWO_WAY_VOICE);
            }
            if($this->customerData["purchaseDetails"]["video"] === true) {
                $addonFeatures->addToAddOnFeatureEnum(AddOnFeatureEnum::VALUE_PRO_VIDEO);
                if($this->customerData["purchaseDetails"]["skybell"] === true) {
                    $addonFeatures->addToAddOnFeatureEnum(AddOnFeatureEnum::VALUE_DOORBELL_CAMERAS);
                }
            } else if($this->customerData["purchaseDetails"]["skybell"] === true) {
                $addonFeatures->addToAddOnFeatureEnum(AddOnFeatureEnum::VALUE_BASIC_DOORBELL);
            }
            return $addonFeatures;
        }
        
        public function setCustomerNotifications() {
            $customerNotifications = new ArrayOfCustomerNotificationEnum();
            $this->customerData["ADC Custom Notifications"] = "alarms;arming;disarming;power failure;bypassed";
            $notifications = explode(";", $this->customerData["ADC Custom Notifications"]);
            $validNotifications = [
                "alarms" => CustomerNotificationEnum::VALUE_ALARMS,
                "arming" => CustomerNotificationEnum::VALUE_ARMING,
                "disarming" => CustomerNotificationEnum::VALUE_DISARMING,
                "power failure" => CustomerNotificationEnum::VALUE_POWER_FAILURE,
                "power restored" => CustomerNotificationEnum::VALUE_POWER_RESTORED,
                "low battery" => CustomerNotificationEnum::VALUE_LOW_BATTERY,
                "bypassed" => CustomerNotificationEnum::VALUE_BYPASSED,
                "tamper" => CustomerNotificationEnum::VALUE_TAMPER,
                "malfunction" => CustomerNotificationEnum::VALUE_MALFUNCTION,
                "camera not responding" => CustomerNotificationEnum::VALUE_CAMERA_NOT_RESPONDING,
                "camera upload limits" => CustomerNotificationEnum::VALUE_CAMERA_UPLOAD_LIMITS,
                "sms over quota" => CustomerNotificationEnum::VALUE_SMS_OVER_QUOTA,
                "panel not responding" => CustomerNotificationEnum::VALUE_PANEL_NOT_RESPONDING,
                "arming reminder" => CustomerNotificationEnum::VALUE_ARMING_REMINDER,
                "insights" => CustomerNotificationEnum::VALUE_INSIGHTS,
            ];
            foreach($notifications as $key => $notification) {
                if(array_key_exists($key, $validNotifications)) $customerNotifications->addToCustomerNotificationEnum($validNotifications[strtolower($notification)]);
            }
            return $customerNotifications;
        }
        
        public function setPropertyType() {
            $validPropertyTypes = [
                "none" => PropertyTypeEnum::VALUE_NOT_SET,
                "residential" => PropertyTypeEnum::VALUE_SINGLE_FAMILY_HOUSE,
                "commercial" => PropertyTypeEnum::VALUE_SINGLE_FAMILY_HOUSE
            ];
            return $validPropertyTypes[strtolower($this->customerData["property"]["propertyType"])];
        }
    }