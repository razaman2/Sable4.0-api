<?php
    
    namespace App\Helpers\ADC\Enums;
    
    use App\Helpers\ApiBuilder\BaseData;
    use App\Helpers\ApiBuilder\Interfaces\EnumResponsible;
    use App\Helpers\ApiBuilder\Traits\DataEnums;

    abstract class ADCEnum extends BaseData implements EnumResponsible
    {
        use DataEnums;
    
        /**
         * @core
         */
        public function toArray() {
            if(!is_null(parent::toArray())) {
                foreach(parent::toArray() as $value) {
                    $data[] = $value;
                }
                return $data;
            } else {
                return [];
            }
        }
    }
