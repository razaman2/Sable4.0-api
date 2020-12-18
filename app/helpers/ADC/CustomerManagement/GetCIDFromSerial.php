<?php
    
    namespace App\Helpers\ADC;
    
    use Wsdl\ADC\CustomerManagement\StructType\GetCustomerBestPractices;
    
    class GetCIDFromSerial extends CustomerManagement
    {
        public function getCustomerBestPractices($customerId) {
            
            return $this->execute($this->operation->GetCustomerBestPractices(new GetCustomerBestPractices($customerId)), function($result) {
                
                return $result->GetCustomerBestPracticesResult;
            });
        }
    }
