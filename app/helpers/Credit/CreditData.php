<?php

    namespace Helpers\Credit;

    use App\helpers\Credit\CreditCredentials;
    use Helpers\Builder\MethodInvoker;

    abstract class CreditData
    {
        protected $data = [];
        protected CreditCredentials $credentials;

        public function __construct($data) {
            $this->default();

            (new MethodInvoker($this))->invoke($data);
        }

        public function pass($pass) {
            $this->data['PASS'] = $pass;
        }

        public function credentials($data) {
            $this->credentials = (new CreditCredentials($data));
        }

        public function bureau($bureau) {
            $this->data['BUREAU'] = strtoupper($bureau);
        }

        public function getData() {
            return array_merge($this->data, $this->credentials->getData());
        }

        public function getBureau() {
            return $this->data['BUREAU'];
        }

        protected abstract function default();
    }
