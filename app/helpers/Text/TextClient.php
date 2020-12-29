<?php

    namespace Helpers\Text;

    use Twilio\Rest\Client;

    trait TextClient
    {
        protected function setup() {
            try {
                return new Client(env("TWILIO_SID"), env("TWILIO_TOKEN"));
            } catch(\Exception $e) {
                return $e->getMessage();
            }
        }
    }
