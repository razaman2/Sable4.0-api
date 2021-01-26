<?php

    namespace Helpers\Credit;

    class PullPrevious extends CreditData
    {
        protected $bureau;

        public function default() {
            $this->pass("109");
        }

        public function token($token) {
            $this->data['TOKEN'] = $token;
        }

        public function bureau($bureau) {
            $this->bureau = $bureau;
        }

        public function getBureau() {
            return $this->bureau;
        }
    }
