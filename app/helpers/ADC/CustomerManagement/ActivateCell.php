<?php
    
    namespace App\Helpers\ADC;

    use App\Helpers\ADC\ContainerTest\ADCAddress;
    use App\Helpers\ADC\ContainerTest\ADCAddressWithName;
    use App\Helpers\ADC\ContainerTest\ADCCreateCustomerInput;
    use Wsdl\ADC\CustomerManagement\ServiceType\Create;
    use Wsdl\ADC\CustomerManagement\StructType\CreateCustomer;

    class ActivateCell extends CustomerManagement
    {
        protected $customerInput, $address, $addressWithName;
    
        public function activate() {
            $this->customerInput->setBranchId($this->credentials->branchId());
            $this->customerInput->setCustomerAccountAddress($this->addressWithName);
            $this->customerInput->setInstallationAddress($this->address);
        
            return $this->execute($this->operation->CreateCustomer(new CreateCustomer($this->customerInput)), function($result) {
                return $result;
            });
        }
    
        public function contact(ADCAddressWithName $data) {
            $this->addressWithName = $data;
        }
    
        public function property(ADCAddress $data) {
            $this->address = $data;
        }
    
        public function customer(ADCCreateCustomerInput $data) {
            $this->customerInput = $data;
        }
    
        protected function setOperation() {
            return new Create($this->options());
        }
    }
