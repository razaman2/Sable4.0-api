<?php

    namespace Helpers\ADC\LeadsService;

    use Helpers\ADC\ADCManagement;
    use WebService\ADC\LeadManagement\ServiceType\Get;
    use WebService\ADC\LeadManagement\StructType\Authentication;

    abstract class LeadManagement extends ADCManagement
    {
        protected function authenticator(...$params) {
            return new Authentication(...$params);
        }

        protected function setOperation() {
            return new Get($this->options());
        }

        protected function getUrl() : string {
            return env('ADC_LEADS_SERVICE_URL');
        }
    }
