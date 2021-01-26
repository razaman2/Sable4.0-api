<?php

    namespace Helpers\Credit;

    class Experian extends CreditOperation
    {
        public function getScore() {
            try {
                return intval($this->getResponse()->bureau_xml_data->XPN_Report->subject_segments->risk_models->risk_model->score);
            } catch(\Exception $e) {
                return 0;
            }
        }
    }
