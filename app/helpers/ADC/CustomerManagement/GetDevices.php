<?php

    namespace Helpers\ADC\CustomerManagement;

    use WebService\ADC\CustomerManagement\StructType\GetDeviceList;
    use WebService\ADC\CustomerManagement\StructType\GetFullEquipmentList;

    class GetDevices extends CustomerManagement
    {
        public function getDeviceList($id) {
            return $this->execute($this->operation->GetDeviceList(new GetDeviceList($id)), function($result) {
                return $this->getZones($result->GetDeviceListResult);
            });
        }

        public function getFullEquipmentList($id) {
            return $this->execute($this->operation->GetFullEquipmentList(new GetFullEquipmentList($id)), function($result) {
                return $this->getZones($result->GetFullEquipmentListResult);
            });
        }

        protected function getZones($data) {
            try {
                return $data->PanelDevice;
            } catch(\Exception $e) {
                return [];
            }
        }
    }
