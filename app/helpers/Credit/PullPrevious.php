<?php

    namespace Helpers\Credit;

    class PullPrevious extends CreditData
    {
        public function default() {
            $this->pass("109");
        }

        public function token($token) {
            $this->requestData['TOKEN'] = $token;
        }
    }
