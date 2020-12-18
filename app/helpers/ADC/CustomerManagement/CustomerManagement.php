<?php

    namespace Helpers\ADC\CustomerManagement;

    use Helpers\ADC\ADCManagement;
    use WebService\ADC\CustomerManagement\ServiceType\Get;
    use WebService\ADC\CustomerManagement\StructType\Authentication;

    abstract class CustomerManagement extends ADCManagement
    {
        protected function getUrl() : string {
            return env("ADC_CUSTOMER_MANAGEMENT_URL");
        }

        protected function setOperation() {
            return new Get($this->options());
        }

        protected function authenticator(...$params) {
            return new Authentication(...$params);
        }
    }
