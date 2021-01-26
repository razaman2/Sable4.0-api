<?php


    namespace App\helpers\Credit;

    use Helpers\Builder\MethodInvoker;

    class CreditAddress
    {
        protected $data = [];

        public function __construct($data) {
            (new MethodInvoker($this))->invoke($data);
        }

        public function address1($address1) {
            $this->data['ADDRESS'] = $address1;
        }

        public function city($city) {
            $this->data['CITY'] = $city;
        }

        public function state($state) {
            $this->data['STATE'] = $state;
        }

        public function zip($zip) {
            $this->data['ZIP'] = $zip;
        }

        public function getData() {
            return $this->data;
        }
    }
