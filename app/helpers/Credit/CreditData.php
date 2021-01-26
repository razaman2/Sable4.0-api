<?php

    namespace Helpers\Credit;

    use App\helpers\Credit\CreditCredentials;
    use Helpers\Builder\MethodInvoker;

    abstract class CreditData
    {
        protected $data = [];
        protected $type = 'score';
        protected CreditCredentials $credentials;

        public function __construct($data) {
            $this->default();

            (new MethodInvoker($this))->invoke($data);
        }

        public function pass($pass) {
            $this->data['PASS'] = $pass;
        }

        public function auth($data) {
            $this->credentials = (new CreditCredentials($data));
        }

        public function data($data) {
            (new MethodInvoker($this))->invoke($data);
        }

        public function type($type) {
            $this->type = $type;
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

        public function getType() {
            return $this->type;
        }

        protected abstract function default();
    }
