<?php

    namespace Helpers\Credit;

    use App\helpers\Credit\CreditAddress;
    use App\helpers\Credit\CreditContact;

    class PullNew extends CreditData
    {
        protected CreditContact $contact;
        protected CreditAddress $address;

        public function default() {
            $this->pass("2");
            $this->process("PCCREDIT");
            $this->product("CREDIT");
        }

        public function process($process) {
            $this->data['PROCESS'] = $process;
        }

        public function product($product) {
            $this->data['PRODUCT'] = $product;
        }

        public function contact($data) {
            $this->contact = new CreditContact($data);
        }

        public function address($data) {
            $this->address = new CreditAddress($data);
        }

        public function getData() {
            return array_merge(parent::getData(), $this->contact->getData(), $this->address->getData());
        }
    }
