<?php

    namespace Helpers\ADC\CustomerManagement;

    use WebService\ADC\CustomerManagement\StructType\GetCustomerBestPractices;

    class GetBestPractices extends CustomerManagement
    {
        public function get($customerId) {
            return $this->execute($this->operation->GetCustomerBestPractices(new GetCustomerBestPractices($customerId)), function($result) {
                return $result->GetCustomerBestPracticesResult;
            });
        }
    }
