<?php

    namespace Helpers\ADC\LeadsService;

    use WebService\ADC\LeadManagement\StructType\GetReadyForTransferLeadList;
    use WebService\ADC\LeadManagement\StructType\GetReadyForTransferLeadListInput;

    class GetTransferLeadList extends LeadManagement
    {
        public function get($dateFrom = null) {
            return $this->execute($this->operation->GetReadyForTransferLeadList(new GetReadyForTransferLeadList(new GetReadyForTransferLeadListInput($dateFrom))), function($result) {
                return $result->GetReadyForTransferLeadListResult;
            });
        }
    }
