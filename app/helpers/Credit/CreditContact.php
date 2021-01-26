<?php


    namespace App\helpers\Credit;

    use Helpers\Builder\MethodInvoker;

    class CreditContact
    {
        protected $data = [];

        public function __construct($data) {
            (new MethodInvoker($this))->invoke($data);
        }

        public function firstName($name) {
            $this->data['NAME'] = array_key_exists('NAME', $this->data) ? "{$name} {$this->data['NAME']}" : $name;
        }

        public function lastName($name) {
            $this->data['NAME'] = array_key_exists('NAME', $this->data) ? "{$this->data['NAME']} {$name}" : $name;
        }

        public function ssn($ssn) {
            $this->data['SSN'] = $ssn;
        }

        public function dob($dob) {
            $this->data['DOB'] = $dob;
        }

        public function getData() {
            return $this->data;
        }
    }
