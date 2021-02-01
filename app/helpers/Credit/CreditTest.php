<?php

    namespace App\helpers\Credit;

    use Helpers\Builder\MethodInvoker;

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
            $response = (new MethodInvoker($this, true))->invoke($data, $this->getResponse($data));

            return $response->options;
        }

        private function options($data, $response) {
            $option = (new MethodInvoker($this, true))->invoke([$data => $data]);

            return array_merge($response, ['score' => $option->{$data}]);
        }

        private function pass() {
            return rand(600, 850);
        }

        private function fail() {
            return rand(400, 599);
        }

        private function notfound() {
            return 0;
        }
    }
