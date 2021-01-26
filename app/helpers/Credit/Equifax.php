<?php

    namespace Helpers\Credit;

    class Equifax extends CreditOperation
    {
        public function getScore() {
            try {
                return intval($this->getResponse()->bureau_xml_data->EFX_Report->subject_segments->beacon->score);
            } catch(\Exception $e) {
                return 0;
            }
        }
    }
