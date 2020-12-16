<?php
    namespace Helpers\ADC\DealerManagement;

    use WebService\ADC\DealerManagement\StructType\GetDealerId as DealerIDService;

    class GetDealerID extends DealerManagement
    {
        public function get() {
            return $this->execute($this->operation->GetDealerId(new DealerIDService()), function($result) {
                return $result;
            });
        }
    }
