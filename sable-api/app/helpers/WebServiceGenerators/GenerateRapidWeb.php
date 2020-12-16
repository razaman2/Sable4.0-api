<?php
    
    namespace Helpers\WebServiceGenerators;
    
    class GenerateRapidWeb extends WebServiceGenerator
    {
        protected $dirName = 'RapidWeb';
        protected $wsdlUrl = 'https://rapidweb3000.com/StagesGatewayExternalDev145/Gateway.asmx?wsdl';
        
        public function __construct($directory = 'vendor/generated') {
            $this->longRunningTask();
            parent::__construct($directory);
        }
    }
