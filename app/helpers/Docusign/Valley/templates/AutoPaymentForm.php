<?php
    
    namespace App\Helpers\Docusign\Valley\templates;
    
    use App\Helpers\Docusign\Template;
    
    class AutoPaymentForm extends Template {
        protected $sequence = 5;
        
        protected $name = 'Auto Payment Form';
        
        protected function salesperson($data) {
            $this->new('text_tabs')->setTabLabel("salesperson")->setValue($data);
        }
        
        protected function customer($data) {
            $this->new('text_tabs')->setTabLabel("name")->setValue($data);
        }
        
        protected function address($data) {
            $this->new('text_tabs')->setTabLabel("address")->setValue($data);
        }
        
        protected function city($data) {
            $this->new('text_tabs')->setTabLabel("city")->setValue($data);
        }
        
        protected function state($data) {
            $this->new('text_tabs')->setTabLabel("state")->setValue($data);
        }
        
        protected function zip($data) {
            $this->new('zip_tabs')->setTabLabel("zip")->setValue($data);
        }
        
        protected function phone($data) {
            $phone = preg_replace('/\D/', '', $data);
            preg_match("/^(\d{3})(\d{3})(\d{4})$/", $phone, $matches);
            if(!empty($matches)) {
                $this->new('text_tabs')->setTabLabel("pre phone")->setValue($matches[1]);
                $this->new('text_tabs')->setTabLabel("post phone")->setValue("{$matches[2]}-{$matches[3]}");
            }
        }
        
        protected function expirationDate($data) {
            $this->new('text_tabs')->setTabLabel("card expiration date")->setValue($data);
        }
        
        protected function cardNumber($data) {
            $this->new('text_tabs')->setTabLabel("credit card number")->setValue($data);
        }
        
        protected function accountNumber($data) {
            $this->new('text_tabs')->setTabLabel("bank account number")->setValue($data);
        }
        
        protected function routingNumber($data) {
            $this->new('text_tabs')->setTabLabel("bank routing number")->setValue($data);
        }
        
        protected function securityCode($data) {
            $this->new('text_tabs')->setTabLabel("security code")->setValue($data);
        }
        
        protected function rmr($data) {
            $this->new('text_tabs')->setTabLabel("rmr")->setValue($data);
        }
        
        protected function amount($data) {
            $this->new('text_tabs')->setTabLabel("amount")->setValue($data);
        }
        
        protected function paymentType($data) {
            $this->new('radio_group_tabs')->setGroupName("payment type")->setRadios([
                $this->new('radio_tab')->setSelected(true)->setValue($data),
            ]);
        }
        
        protected function cardType($data) {
            $cardTypes = [
                'mc' => 'mc/visa',
                'visa' => 'mc/visa',
                'amex' => 'amex',
            ];
            $this->new('radio_group_tabs')->setGroupName("card type")->setRadios([
                $this->new('radio_tab')->setSelected(true)->setValue($cardTypes[$data]),
            ]);
        }
        
        protected function oneTimePayment($data) {
            $this->new('checkbox_tabs')->setTabLabel("one time payment")->setSelected($data);
        }
        
        protected function invoiceViaEmail($data) {
            $this->new('checkbox_tabs')->setTabLabel("invoice via email")->setSelected($data);
        }
    
        /**
         * Exclude this document when payment method is invoice only.
         */
        public function isIncluded(array $data) {
            return !(array_key_exists('invoice', $data) && $data['invoice']);
        }
    
        public function build(array $data) : array {
            $this->customer($data['name']);
            $this->salesperson($data['salesperson']);
            
            if(array_key_exists('phone', $data)) {
                $this->phone($data['phone']);
            }
            
            $this->address($data['address1']);
            $this->city($data['city']);
            $this->state($data['state']);
            $this->zip($data['zip']);
            
            $this->rmr($data['rmr']);
            $this->amount($data['installFee']);
            
            return parent::build($data);
        }
    }
