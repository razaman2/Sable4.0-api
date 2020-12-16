<?php
    
    namespace Helpers\WebServiceGenerators;
    
    class GenerateADCLeadsService extends WebServiceGenerator
    {
        protected $dirName = 'ADC/LeadManagement';
        protected $wsdlUrl = 'https://alarmadmin.alarm.com/webservices/customerleadservice.asmx?wsdl';
    }
