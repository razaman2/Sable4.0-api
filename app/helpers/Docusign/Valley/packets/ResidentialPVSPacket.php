<?php
    
    namespace App\Helpers\Docusign\Valley\packets;
    
    use App\Helpers\Docusign\Packet;
    use App\Helpers\Docusign\Valley\templates\AlarmServiceAgreement;
    use App\Helpers\Docusign\Valley\templates\AutomatedServicesChecklist;
    use App\Helpers\Docusign\Valley\templates\NoticeOfCancellation;
    use App\Helpers\Docusign\Valley\templates\NoticeToOwner;
    use App\Helpers\Docusign\Valley\templates\PVSAutoPaymentForm;
    use App\Helpers\Docusign\Valley\templates\PVSConsumerCreditApplication;
    use App\Helpers\Docusign\Valley\templates\PVSResponsiblePersonsList;
    use App\Helpers\Docusign\Valley\templates\PVSWaiverOfRightToCancel;
    
    class ResidentialPVSPacket extends Packet {
        public function setup(array $data) {
            $this->add(new AlarmServiceAgreement($this->api));
            $this->add(new PVSConsumerCreditApplication($this->api));
            if(array_key_exists('invoice', $data) && !$data['invoice']) {
                $this->add(new PVSAutoPaymentForm($this->api));
            }
            $this->add(new PVSResponsiblePersonsList($this->api));
            $this->add(new PVSWaiverOfRightToCancel($this->api));
            $this->add(new NoticeToOwner($this->api));
            $this->add(new NoticeOfCancellation($this->api));
            $this->add(new AutomatedServicesChecklist($this->api));
        }
    }
