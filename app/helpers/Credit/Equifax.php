<?php

    namespace Helpers\Credit;

    class Equifax extends CreditOperation
    {
        public function getScore() {
            $credit = parent::getScore();
            try {
                $credit->score = intval($this->response->bureau_xml_data->EFX_Report->subject_segments->beacon->score);
            } catch(\Exception $e) {
                $credit->score = 0;
            }
            return $credit;
        }
    }
