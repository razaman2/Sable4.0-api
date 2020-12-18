<?php

    namespace Helpers\ADC\DealerManagement;

    use Helpers\ADC\ADCManagement;
    use WebService\ADC\DealerManagement\ServiceType\Get;
    use WebService\ADC\DealerManagement\StructType\Authentication;

    abstract class DealerManagement extends ADCManagement
    {
        protected function getUrl() : string {
            return env("ADC_DEALER_MANAGEMENT_URL");
        }

        protected function setOperation() {
            return new Get($this->options());
        }

        protected function authenticator(...$params) {
            return new Authentication(...$params);
        }
    }
