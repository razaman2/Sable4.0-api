<?php

    namespace Helpers\Credit;

    use Helpers\Builder\MethodInvoker;

    class CreditData
    {
        protected $data;
        protected $requestData = [];

        public function __construct($data) {
            $this->data = $data;

            $this->default();

            (new MethodInvoker($this))->invoke($data);
        }

        public function pass($pass) {
            $this->requestData['PASS'] = $pass;
        }

        public function username($username) {
            $this->requestData['ACCOUNT'] = $username;
        }

        public function password($password) {
            $this->requestData['PASSWD'] = $password;
        }

        public function bureau(BureauEnum $bureau) {
            $this->requestData['BUREAU'] = $bureau;
        }

        public function getData() {
            return $this->requestData;
        }

        public function getBureau() {
            return $this->requestData['BUREAU'];
        }

        protected function default() {
        }
    }
