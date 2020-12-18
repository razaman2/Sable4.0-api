<?php

    namespace Helpers\ADC;

    use Helpers\Interfaces\Authentication;

    class ADCAuth implements Authentication
    {
        protected $branchID;
        protected $username;
        protected $password;
        protected $twoFactor;

        public function __construct($username, $password, $branchID = 0, $twoFactor = '') {
            $this->username = $username;
            $this->password = $password;
            $this->branchID = $branchID;
            $this->twoFactor = $twoFactor;
        }

        public function branchID() : int {
            return $this->branchID;
        }

        public function username() {
            return $this->username;
        }

        public function password() {
            return $this->password;
        }

        public function twoFactor() : string {
            return $this->twoFactor;
        }
    }
