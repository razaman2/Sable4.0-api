<?php

    namespace Helpers\Credit;

    class TransUnion extends CreditOperation
    {
        public function getScore() {
            $credit = parent::getScore();
            try {
                $credit->score = intval($this->response->bureau_xml_data->TU_Report->subject_segments->scoring_segments->scoring->score[0]);
            } catch(\Exception $e) {
                $credit->score = 0;
            }
            return $credit;
        }
    }
