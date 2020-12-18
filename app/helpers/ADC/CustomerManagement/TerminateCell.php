<?php

    namespace Helpers\ADC\CustomerManagement;

    use WebService\ADC\CustomerManagement\ServiceType\Terminate;
    use WebService\ADC\CustomerManagement\StructType\TerminateCustomer;

    class TerminateCell extends CustomerManagement
    {
        public function terminate($customerId) {
            return $this->execute($this->operation->TerminateCustomer(new TerminateCustomer($customerId)), function($result) {
                return $result;
            });
        }

        protected function setOperation() {
            return new Terminate($this->options());
        }
    }
