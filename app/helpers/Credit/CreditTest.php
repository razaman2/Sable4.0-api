<?php

    namespace App\helpers\Credit;

    class CreditTest
    {
        private function getResponse($data) {
            return [
                'transId' => (string) rand(100000000, 999999999),
                'token' => str_shuffle('R8YErzfEpwa0xO8MRXU5zprPsiCE5OdCj0Y99701mHkS3n0Cg1JpSFNsIBTWRgoWDZpVZO80gV4oZWvr6mKrJOeSFkKPylAk/QrCd84cL+m53Q').'==',
                'bureau' => $data['data']['bureau']
            ];
        }

        public function execute($data) {
            $response = $this->getResponse($data);

            if($data['options'] === 'pass') {
                $this->pass($response);
            } else if($data['options'] === 'fail') {
                $this->fail($response);
            } else {
                $this->notFound($response);
            }

            return $response;
        }

        public function pass(&$data) {
            $data['score'] = rand(600, 850);
        }

        public function fail(&$data) {
            $data['score'] = rand(400, 599);
        }

        public function notFound(&$data) {
            $data['score'] = 0;
        }
    }
