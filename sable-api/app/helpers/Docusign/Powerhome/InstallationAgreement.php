<?php
    
    namespace App\Helpers\Docusign\Powerhome;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;
    use Exception;

    class InstallationAgreement extends TemplateTabs implements Defaultable {
        //private $equipmentTotal = 0;
        //private $prepaidMonitoring = 0;
        //
        //public function __construct($data, $config = []) {
        //    parent::__construct($data, $config);
        //
        //    $this->equipmentTotal = array_reduce($this->data['equipment'], function ($total, $equipment) {
        //        return ($total + $equipment['price']);
        //    }, 0);
        //
        //    $this->prepaidMonitoring = $this->data['billing']['rmr'] * $this->data['monthsPaidUpfront'];
        //}
    
        public function config($properties = []) {
            return parent::config(array_merge($properties, [
                'name' => 'Installation Agreement',
            ]));
        }
    
        protected function subscriber1() {
            $name = join(' ', [$this->data['signers'][0]['firstName'], $this->data['signers'][0]['lastName']]);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber1Name")
                ->setXPosition(89)
                ->setYPosition(119)
                ->setLocked(true)
                ->setValue($name);
        }
    
        protected function subscriber2() {
            $name = join(' ', [$this->data['signers'][1]['firstName'], $this->data['signers'][1]['lastName']]);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber2Name")
                ->setXPosition(62)
                ->setYPosition(134)
                ->setLocked(true)
                ->setValue($name);
        }
    
        protected function nameOfBusiness() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-NameOfBusiness")
                ->setXPosition(72)
                ->setYPosition(150)
                ->setLocked(true)
                ->setValue($this->data['companyName']);
        }
    
        protected function businessType() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-BusinessType")
                ->setXPosition(300)
                ->setYPosition(150)
                ->setLocked(true)
                ->setValue($this->data['companyType']);
        }
    
        protected function property($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PremiseAddress")
                ->setXPosition(72)
                ->setYPosition(170)
                ->setLocked(true)
                ->setValue(join(', ', [$data['address1'], $data['address2']]));
        
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PremiseCityStateZip")
                ->setXPosition(72)
                ->setYPosition(180)
                ->setLocked(true)
                ->setValue(join(', ', [$data['city'], $data['state'], $data['zip']]));
        }
    
        protected function billing($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-BillingAddress")
                ->setXPosition(95)
                ->setYPosition(193)
                ->setLocked(true)
                ->setValue(join(', ', [$data['address1'], $data['address2']]));
        
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-BillingCityStateZip")
                ->setXPosition(95)
                ->setYPosition(205)
                ->setLocked(true)
                ->setValue(join(', ', [$data['city'], $data['state'], $data['zip']]));
        }
    
        protected function subscriber1Phone() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber1Phone")
                ->setXPosition(90)
                ->setYPosition(239)
                ->setLocked(true)
                ->setValue($this->data['signers'][0]['phone']);
        }
    
        protected function subscriber1Email() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber1Email")
                ->setXPosition(90)
                ->setYPosition(278)
                ->setLocked(true)
                ->setValue($this->data['signers'][0]['email']);
        }
    
        protected function subscriber2Phone() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber2Phone")
                ->setXPosition(75)
                ->setYPosition(258)
                ->setLocked(true)
                ->setValue($this->data['signers'][1]['phone']);
        }
    
        protected function passcode($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Password")
                ->setXPosition(45)
                ->setYPosition(294)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function promoMonths($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Password")
                ->setXPosition(377)
                ->setYPosition(953)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function monthsPaidUpfront($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Password")
                ->setXPosition(507)
                ->setYPosition(953)
                ->setLocked(true)
                ->setValue($data);
        }
    
        protected function dateOfTransaction() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-DateOfTransaction")
                ->setXPosition(508)
                ->setYPosition(140);
        }
    
        protected function paymentInformation() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PaymentInformation")
                ->setXPosition(357)
                ->setYPosition(926)
                ->setLocked(true)
                ->setValue(preg_replace("/\d(?=\d{4})/", '*', $this->getPaymentInfo($this->data['payment']['initial'])));
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
    
        protected function equipment($data) {
            $equipments = array_slice($data, 0, 30);
            $positionX = ['name' => 11, 'pts' => 272, 'qty' => "335", 'price' => "407", 'total' => 527];
            $positionY = 520;
            array_walk($equipments, function($equipment, $index) use (&$positionX, &$positionY) {
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-item{$index}-EquipmentName")
                    ->setXPosition($positionX['name'])
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue($equipment['name']);
            
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-item{$index}-EquipmentPoints")
                    ->setXPosition($positionX['pts'])
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue($equipment['points']);
    
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-item{$index}-EquipmentQuantity")
                    ->setXPosition($positionX['qty'])
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue($equipment['quantity']);
    
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-item{$index}-EquipmentPrice")
                    ->setXPosition($positionX['price'])
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue($equipment['unitPrice']);
                
                $this->new('text_tabs')
                    ->setTabLabel("{$this->config['name']}-item{$index}-EquipmentTotal")
                    ->setXPosition($positionX['total'])
                    ->setYPosition($positionY)
                    ->setLocked(true)
                    ->setValue($equipment['price']);
                
                $positionY += 9;
            });
        }
    
        protected function subscriber1Signature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber1Signature")
                ->setXPosition(82)
                ->setYPosition(1049);
        }
    
        protected function subscriber2Signature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-Subscriber2Signature")
                ->setXPosition(82)
                ->setYPosition(1093);
        }
    
        protected function salesperson($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-SalespersonName")
                ->setXPosition(295)
                ->setYPosition(1089)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function paymentBreakdown() {
            $equipmentTotal = array_reduce($this->data['equipment'], function ($total, $equipment) {
                return ($total + $equipment['price']);
            }, 0);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Subtotal")
                ->setXPosition(490)
                ->setYPosition(765)
                ->setLocked(true)
                ->setValue("\${$this->data['total']}");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Other")
                ->setXPosition(490)
                ->setYPosition(777)
                ->setLocked(true)
                ->setValue("\${$equipmentTotal}");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Permits")
                ->setXPosition(490)
                ->setYPosition(789)
                ->setLocked(true)
                ->setValue("\$0");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Tax")
                ->setXPosition(490)
                ->setYPosition(801)
                ->setLocked(true)
                ->setValue("\$0");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Total")
                ->setXPosition(490)
                ->setYPosition(812)
                ->setLocked(true)
                ->setValue("\${$this->data['total']}");
        }
        
        protected function initialPaymentDue() {
            $prepaidMonitoring = $this->data['billing']['rmr'] * $this->data['monthsPaidUpfront'];
            $initialPayment = $prepaidMonitoring + $this->data['total'];
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-InitialPaymentAmount")
                ->setXPosition(500)
                ->setYPosition(872)
                ->setLocked(true)
                ->setValue("\${$initialPayment}");
        }
        
        protected function initialPaymentInfo() {
            $prepaidMonitoring = $this->data['billing']['rmr'] * $this->data['monthsPaidUpfront'];
            $equipmentTotal = array_reduce($this->data['equipment'], function ($total, $equipment) {
                return ($total + $equipment['price']);
            }, 0);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-InitialPaymentPrepaidMonitoring")
                ->setXPosition(390)
                ->setYPosition(847)
                ->setLocked(true)
                ->setValue("\${$prepaidMonitoring}");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-InitialPaymentActivationFee")
                ->setXPosition(390)
                ->setYPosition(862)
                ->setLocked(true)
                ->setValue("\${$this->data['billing']['activationFee']}");
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-InitialPaymentTotalEquip/Other")
                ->setXPosition(390)
                ->setYPosition(875)
                ->setLocked(true)
                ->setValue("\${$equipmentTotal}");
        }
        
        protected function paymentCount($data) {
            $term = preg_replace("/\D/", '', $data);
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PaymentCount")
                ->setXPosition(67)
                ->setYPosition(939)
                ->setLocked(true)
                ->setValue($term);
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
            $this->paymentBreakdown();
            $this->initialPaymentDue();
            $this->initialPaymentInfo();
            if(count($this->data['signers']) > 1) {
                $this->subscriber2();
                $this->subscriber2Phone();
                $this->subscriber2Signature();
            }
        }
    }
