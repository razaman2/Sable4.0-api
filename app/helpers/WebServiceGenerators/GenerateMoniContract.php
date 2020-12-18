<?php
    
    namespace Helpers\WebServiceGenerators;
    
    class GenerateMoniContract extends WebServiceGenerator
    {
        protected $dirName = 'MoniContract';
        protected $wsdlUrl = 'https://mimasweb.monitronics.net/eContractAPI?wsdl';
        //protected $wsdlUrl = 'https://senti.monitronics.net/eContractAPISIT?wsdl'; //test env
    }
