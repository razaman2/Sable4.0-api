<?php

    namespace Helpers\ADC;

    use Helpers\Interfaces\Authenticateable;
    use Helpers\WebServiceDescription;
    use WsdlToPhp\PackageBase\AbstractSoapClientBase;

    abstract class ADCManagement extends WebServiceDescription implements Authenticateable
    {
        protected function options() : array {
            return array_merge(parent::options(), [
                AbstractSoapClientBase::WSDL_SOAP_VERSION => SOAP_1_2,
            ]);
        }

        public function authenticate($auth) {
            $authentication = $this->authenticator($auth->username(), $auth->password(), $auth->twoFactor());
            $this->operation->setSoapHeaderAuthentication($authentication);
        }

        protected function authenticator(...$params) {
            return $params;
        }
    }
