<?php

    namespace Helpers\Credit;

    interface CreditFormat
    {
        public function getTty();

        public function getScore();

        public function getHtml();
    }
