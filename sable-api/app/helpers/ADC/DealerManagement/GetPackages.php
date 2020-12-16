<?php
    namespace Helpers\ADC\DealerManagement;

    use Helpers\ADC\ADCAuth;
    use WebService\ADC\DealerManagement\EnumType\AccountTypeEnum;
    use WebService\ADC\DealerManagement\StructType\GetPackageIds;
    use WebService\ADC\DealerManagement\StructType\GetPackageIdsInput;

    class GetPackages extends DealerManagement
    {
        public function get($filter = AccountTypeEnum::VALUE_NOT_SET) {
            $auth = resolve(ADCAuth::class);

            $dealer = (new GetDealerID($auth))->get();

            return $this->execute($this->operation->GetPackageIds(new GetPackageIds(new GetPackageIdsInput($dealer->GetDealerIdResult->DealerID, $filter, 1))), function($result) {
                return $result;
            });
        }
    }
