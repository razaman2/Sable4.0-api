<?php

    namespace Helpers\Credit;

    use Illuminate\Support\Facades\Http;

    abstract class CreditOperation
    {
        protected $response;
        protected $credit;

        public function __construct(CreditData $credit) {
            $this->credit = $credit;
        }

        public function execute() {
            $response = Http::asForm()->post(env("HART_CREDIT_URL"), $this->credit->getData());
            $this->validate($response);
            return $this;
        }

        public function getTty() {
            return (string) $this->response->TTY_Reports->TTY_Report[0];
        }

        public function getHtml() {
            return (string) $this->response->HTML_Reports->HTML_Report[0];
        }

        public function getScore() {
            $score["transId"] = (string) $this->response->HX5_transaction_information->Transid[0];
            $score["token"] = (string) $this->response->HX5_transaction_information->Token[0];
            $score["bureau"] = $this->data->BUREAU;
            return (object) $score;
        }

        protected function validate($response) {
            try {
                $this->response = simplexml_load_string($response, null, LIBXML_NOCDATA);
            } catch(\Exception $e) {
                if(preg_match('/Login was not successful/', $response)) {
                    throw new \Exception("The Provided User Credentials Are Invalid...");
                } else if(preg_match('/UNAUTHORIZED METHOD OF ACCESS/', $response)) {
                    throw new \Exception("User Not Whitelisted With Hart Credit Systems...");
                } else if(preg_match('/Access Authorization/', $response)) {
                    throw new \Exception("Invalid Request Data Was Entered...");
                }
            }
        }
    }
