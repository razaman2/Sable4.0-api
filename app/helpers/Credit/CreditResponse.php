<?php

    namespace App\helpers\Credit;

    use Helpers\Credit\CreditFormat;
    use Helpers\Credit\CreditOperation;

    class CreditResponse implements CreditFormat
    {
        protected $operation;

        public function __construct(CreditOperation $operation) {
            $this->operation = $operation;
        }

        public function getTty() {
            return (string) $this->operation->getResponse()->TTY_Reports->TTY_Report[0];
        }

        public function getScore() {
            $response = $this->operation->getResponse();

            $score["transId"] = (string) $response->HX5_transaction_information->Transid[0];
            $score["token"] = (string) $response->HX5_transaction_information->Token[0];
            $score['score'] = $this->operation->getScore();
            $score["bureau"] = $this->operation->getCredit()->getBureau();

            return (object) $score;
        }

        public function getHtml() {
            return (string) $this->operation->getResponse()->HTML_Reports->HTML_Report[0];
        }
    }
