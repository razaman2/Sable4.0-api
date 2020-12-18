<?php

    namespace Helpers\ADC\DealerManagement;

    use WebService\ADC\DealerManagement\StructType\GetRepList as RepList;

    class GetRepList extends DealerManagement
    {
        public function validate(string $repLogin) {
            try {
                $reps = array_map(function($rep) {
                    return $rep->RepLoginName;
                }, array_filter($this->get()->GetRepListResult->Rep, function($rep) use ($repLogin) {
                    return stristr($rep->RepLoginName, $repLogin);
                }));
                if(count($reps)) {
                    return array_shift($reps);
                } else {
                    return null;
                }
            } catch(\Exception $e) {
                return null;
            }
        }

        public function get() {
            return $this->execute($this->operation->GetRepList(new RepList()), function($result) {
                return $result;
            });
        }
    }
