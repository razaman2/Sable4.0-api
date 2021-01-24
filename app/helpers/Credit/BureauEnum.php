<?php

    namespace Helpers\Credit;

    use Helpers\Builder\BaseEnum;

    class BureauEnum extends BaseEnum
    {
        public function equifax() {
            $this->data("EFX");
        }

        public function experian() {
            $this->data("XPN");
        }

        public function transunion() {
            $this->data("TU");
        }
    }
