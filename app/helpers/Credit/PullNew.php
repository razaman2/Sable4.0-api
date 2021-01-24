<?php

    namespace Helpers\Credit;

    class PullNew extends CreditData
    {
        public function default() {
            $this->pass("2");
            $this->process("PCCREDIT");
            $this->product("CREDIT");
        }

        public function process($process) {
            $this->requestData['PROCESS'] = $process;
        }

        public function product($product) {
            $this->requestData['PRODUCT'] = $product;
        }

        public function name($name) {
            $this->requestData['NAME'] = $name;
        }

        public function address1($address1) {
            $this->requestData['ADDRESS'] = $address1;
        }

        public function city($city) {
            $this->requestData['CITY'] = $city;
        }

        public function state($state) {
            $this->requestData['STATE'] = $state;
        }

        public function zip($zip) {
            $this->requestData['ZIP'] = $zip;
        }

        public function ssn($ssn) {
            $this->requestData['SSN'] = $ssn;
        }

        public function dob($dob) {
            $this->requestData['DOB'] = $dob;
        }
    }
