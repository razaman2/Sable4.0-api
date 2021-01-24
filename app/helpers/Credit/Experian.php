<?php

    namespace Helpers\Credit;

    class Experian extends CreditOperation
    {
        public function getScore() {
            $credit = parent::getScore();
            try {
                $credit->score = intval($this->response->bureau_xml_data->XPN_Report->subject_segments->risk_models->risk_model->score);
            } catch(\Exception $e) {
                $credit->score = 0;
            }
            return $credit;
        }
    }
