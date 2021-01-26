<?php

    namespace Helpers\Credit;

    use App\helpers\Credit\CreditResponse;
    use Illuminate\Support\Facades\Http;

    abstract class CreditOperation
    {
        protected $credit;
        protected $response;

        public function __construct(CreditData $credit) {
            $this->credit = $credit;
        }

        public function execute() : CreditResponse {
            $response = Http::asForm()->post(env("HART_CREDIT_URL"), $this->credit->getData());

            $this->validate($response);

            return new CreditResponse($this);
        }

        protected function validate($response) {
            try {
                $this->response = simplexml_load_string($response, null, LIBXML_NOCDATA);
            } catch(\Exception $e) {
                if(preg_match('/Login was not successful/', $response)) {
                    throw new \Exception("The Provided User Credentials Are Invalid!");
                } elseif(preg_match('/UNAUTHORIZED METHOD OF ACCESS/', $response)) {
                    throw new \Exception("User Not Whitelisted With Hart Credit Systems!");
                } elseif(preg_match('/Access Authorization/', $response)) {
                    throw new \Exception("Invalid Request Data Was Entered!");
                }
            }
        }

        public function getCredit() : CreditData {
            return $this->credit;
        }

        public function getResponse() {
            return $this->response;
        }

        public abstract function getScore();
    }
