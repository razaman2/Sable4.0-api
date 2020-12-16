<?php
    
    namespace App\Helpers\ADC\ContainerTest;
    
    use App\Helpers\ADC\Enums\AddonFeature;
    use App\Helpers\ADC\Enums\CentralStationEventGroup;
    use App\Helpers\ADC\Enums\CentralStationForwarding;
    use App\Helpers\ADC\Enums\Culture;
    use App\Helpers\ADC\Enums\CustomerNotification;
    use App\Helpers\ADC\Enums\InstallationTimeZone;
    use App\Helpers\ADC\Enums\MoniPanel;
    use App\Helpers\ADC\Enums\Package;
    use App\Helpers\ADC\Enums\PanelVersion;
    use App\Helpers\ADC\Enums\SablePropertyTypeOverrides;
    use App\Helpers\ApiBuilder\Container;
    use App\Helpers\ApiBuilder\Formats\Numbers;
    use Wsdl\ADC\CustomerManagement\ArrayType\ArrayOfAddOnFeatureEnum;
    use Wsdl\ADC\CustomerManagement\ArrayType\ArrayOfCentralStationEventGroupEnum;
    use Wsdl\ADC\CustomerManagement\ArrayType\ArrayOfCustomerNotificationEnum;
    use Wsdl\ADC\CustomerManagement\StructType\CreateCustomerInput;

    class ADCCreateCustomerInput extends CreateCustomerInput
    {
        public function __construct() {
            parent::__construct();
            $this->setPhoneLinePresent(false);
        }
        
        public function alarmcom($data) {
            (new Container($this))->build($data);
        }
        
        public function contact($data) {
            (new Container($this))->build($data);
        }
        
        public function property($data) {
            (new Container($this))->build($data);
        }
        
        public function email($data) {
            $this->setCustomerAccountEmail($data);
        }
        
        public function phone($data) {
            $this->setCustomerAccountPhone($data);
        }
        
        public function rep($data) {
            //
        }
        
        public function type(SablePropertyTypeOverrides $data) {
            $this->setPropertyType($data->select());
        }
        
        public function panelType(MoniPanel $data) {
            $this->setPanelType($data->select());
        }
        
        public function centralStationForwarding(CentralStationForwarding $data) {
            $this->setCentralStationForwardingOption($data->select());
        }
        
        public function levelOfService(Package $data) {
            $this->setPackageId($data->select());
        }
        
        public function eventGroups(CentralStationEventGroup $data) {
            $this->setCsEventGroupsToForward(new ArrayOfCentralStationEventGroupEnum($data->toArray()));
        }
        
        public function features(AddonFeature $data) {
            $this->setAddOnFeatures(new ArrayOfAddOnFeatureEnum($data->toArray()));
        }
        
        public function customerNotifications(CustomerNotification $data) {
            $this->setCustomerNotifications(new ArrayOfCustomerNotificationEnum($data->toArray()));
        }
        
        public function installationTimeZone(InstallationTimeZone $data) {
            $this->setInstallationTimeZone($data->select());
        }
        
        public function culture(Culture $data) {
            $this->setCulture($data->select());
        }
        
        public function panelVersion(PanelVersion $data) {
            $this->setPanelVersion($data->select());
        }
        
        public function csNumber($data) {
            $this->setCentralStationAccountNumber($data);
        }
        
        public function receiverNumber($data) {
            $this->setCentralStationReceiverNumber($data);
        }
        
        public function serialNumber($data) {
            $this->setModemSerialNumber($data);
        }
        
        public function desiredLogin(ADCDesiredLogin $data) {
            $this->setDesiredLoginName($data->value());
        }
    
        public function panelPhone(Numbers $data) {
            $this->setPhoneLinePresent(boolval(preg_match('/\d{10}/', $data->value())));
        }
    
        /**
         * @param string $InstallerCode
         */
        //public function setInstallerCode($InstallerCode = null) : void {
        //
        //    if(($this->PanelType === PanelTypeEnum::VALUE_SEMVISTA) || ($this->PanelType === PanelTypeEnum::VALUE_SEMPOWER_SERIES)) {
        //
        //        $this->InstallerCode = $InstallerCode;
        //    }
        //
        //    $this->InstallerCode = $InstallerCode;
        //}
    }
