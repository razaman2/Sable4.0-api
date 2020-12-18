<?php
    
    namespace App\Helpers\Docusign\Powerhome;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;
    use Exception;

    class AlarmMonitoringAgreement extends TemplateTabs implements Defaultable {
        public function config($properties = []) {
            return parent::config(array_merge($properties, [
                'name' => 'Alarm Monitoring Agreement'
            ]));
        }
    
        protected function subscriber1() {
            $name = join(' ', [$this->data['signers'][0]['firstName'], $this->data['signers'][0]['lastName']]);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber1Name")
                ->setXPosition(94)
                ->setYPosition(144)
                ->setLocked(true)
                ->setValue($name);
        }
    
        protected function subscriber2() {
            $name = join(' ', [$this->data['signers'][1]['firstName'], $this->data['signers'][1]['lastName']]);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber2Name")
                ->setXPosition(72)
                ->setYPosition(161)
                ->setLocked(true)
                ->setValue($name);
        }
    
        protected function nameOfBusiness() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-NameOfBusiness")
                ->setXPosition(72)
                ->setYPosition(178)
                ->setLocked(true)
                ->setValue($this->data['companyName']);
        }
    
        protected function businessType() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-BusinessType")
                ->setXPosition(300)
                ->setYPosition(178)
                ->setLocked(true)
                ->setValue($this->data['companyType']);
        }
    
        protected function property($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PremiseAddress")
                ->setXPosition(72)
                ->setYPosition(202)
                ->setLocked(true)
                ->setValue(join(', ', [$data['address1'], $data['address2']]));
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PremiseCityStateZip")
                ->setXPosition(72)
                ->setYPosition(212)
                ->setLocked(true)
                ->setValue(join(', ', [$data['city'], $data['state'], $data['zip']]));
        }
    
        protected function billing($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-BillingAddress")
                ->setXPosition(95)
                ->setYPosition(227)
                ->setLocked(true)
                ->setValue(join(', ', [$data['address1'], $data['address2']]));
        
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-BillingCityStateZip")
                ->setXPosition(95)
                ->setYPosition(237)
                ->setLocked(true)
                ->setValue(join(', ', [$data['city'], $data['state'], $data['zip']]));
        }
    
        protected function subscriber1Phone() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber1Phone")
                ->setXPosition(90)
                ->setYPosition(263)
                ->setLocked(true)
                ->setValue($this->data['signers'][0]['phone']);
        }
    
        protected function subscriber1Email() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber1Email")
                ->setXPosition(90)
                ->setYPosition(308)
                ->setLocked(true)
                ->setValue($this->data['signers'][0]['email']);
        }
    
        protected function subscriber2Phone() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber2Phone")
                ->setXPosition(75)
                ->setYPosition(285)
                ->setLocked(true)
                ->setValue($this->data['signers'][1]['phone']);
        }
    
        protected function dateOfTransaction() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-DateOfTransaction")
                ->setXPosition(505)
                ->setYPosition(160);
        }
        
        protected function paymentInformation() {
            $recurring = $this->data['payment']['recurring'];
            $payment = preg_match("/same\s*as\s*initial/i", $recurring['method']) ? $this->getPaymentInfo($this->data['payment']['initial']) : $this->getPaymentInfo($recurring);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PaymentInformation")
                ->setXPosition(395)
                ->setYPosition(375)
                ->setLocked(true)
                ->setValue(preg_replace("/\d(?=\d{4})/", '*', $payment));
        }
        
        private function getPaymentInfo($data) {
            $paymentMethod = $data['method'];
            if(preg_match("/invoice/i", $paymentMethod)) {
                return $paymentMethod;
            } elseif(preg_match("/credit\s*card/i", $paymentMethod)) {
                return join(' ', [$data['creditCardNumber'], "CC"]);
            } elseif(preg_match("/ach/i", $paymentMethod)) {
                return join(' ', [$data['accountNumber'], $paymentMethod]);
            } else {
                throw new Exception('Invalid payment method provided.');
            }
        }
        
        protected function equipmentAlarmNetwork($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-EquipmentAlarmNetwork")
                ->setXPosition(40)
                ->setYPosition(360)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function extendedServicePlan($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-ExtendedServiceOption")
                ->setXPosition(195)
                ->setYPosition(370)
                ->setLocked(true)
                ->setValue($data ? "Yes" : "No");
        }
    
        protected function paymentCount($data) {
            $term = preg_replace("/\D/", '', $data);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PaymentCount")
                ->setXPosition(380)
                ->setYPosition(593)
                ->setLocked(true)
                ->setValue($term);
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PaymentCount")
                ->setXPosition(70)
                ->setYPosition(835)
                ->setLocked(true)
                ->setValue($term);
        }
    
        protected function amountEachPayment() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-AmountEachPayment")
                ->setXPosition(180)
                ->setYPosition(825)
                ->setLocked(true)
                ->setValue("\${$this->data['billing']['rmr']}");
        }
        
        protected function totalMonthlyPayment() {
            $rmr = $this->data['billing']['rmr'];
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-AmountEachPayment")
                ->setXPosition(270)
                ->setYPosition(342)
                ->setLocked(true)
                ->setValue("\${$rmr}");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Other")
                ->setXPosition(270)
                ->setYPosition(352)
                ->setLocked(true)
                ->setValue("\$0");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-FinalRate")
                ->setXPosition(270)
                ->setYPosition(362)
                ->setLocked(true)
                ->setValue("\${$rmr}");
        }
    
        protected function amountAllPayments() {
            $term = preg_replace("/\D/", '', $this->data['paymentCount']);
            $amount = $this->data['billing']['rmr'] * intval($term);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-AmountAllPayments")
                ->setXPosition(405)
                ->setYPosition(821)
                ->setLocked(true)
                ->setValue("$".round($amount, 2));
        }
    
        protected function salesperson($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-SalespersonName")
                ->setXPosition(325)
                ->setYPosition(1045)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function subscriber1Signature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber1Signature")
                ->setXPosition(82)
                ->setYPosition(1007);
        }
    
        protected function subscriber2Signature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber2Signature")
                ->setXPosition(82)
                ->setYPosition(1056);
        }
    
        public function loadDefaults() {
            $this->dateOfTransaction();
            $this->subscriber1();
            $this->subscriber1Phone();
            $this->subscriber1Email();
            $this->subscriber1Signature();
            $this->nameOfBusiness();
            $this->businessType();
            $this->paymentInformation();
            $this->amountEachPayment();
            $this->amountAllPayments();
            $this->totalMonthlyPayment();
            if(count($this->data['signers']) > 1) {
                $this->subscriber2();
                $this->subscriber2Phone();
                $this->subscriber2Signature();
            }
        }
    }
