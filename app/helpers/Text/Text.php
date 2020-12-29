<?php

    namespace Helpers\Text;

    class Text
    {
        use TextClient;

        protected $phone;

        public function __construct($phone) {
            $this->phone = $phone;
        }

        public function status($response) {
            return $response->status;
        }

        public function send($message) {
            $response = $this->setup()->messages->create($this->phone, [
                'from' => env('TWILIO_NUMBER'),
                'body' => $message,
            ]);

            return $this->status($response);
        }
    }
