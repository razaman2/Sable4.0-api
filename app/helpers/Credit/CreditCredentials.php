<?php


    namespace App\helpers\Credit;


    use Helpers\Builder\MethodInvoker;

    class CreditCredentials
    {
        protected $data = [];

        public function __construct($data) {
            (new MethodInvoker($this))->invoke($data);
        }

        public function username($username) {
            $this->data['ACCOUNT'] = $username;
        }

        public function password($password) {
            $this->data['PASSWD'] = $password;
        }

        public function getData() {
            return $this->data;
        }
    }
