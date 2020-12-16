<?php
    
    namespace App\Helpers\Docusign\Valley\packets;
    
    use App\Helpers\Docusign\Packet;
    use App\Helpers\Docusign\Valley\templates\AlarmServiceAgreement;
    use App\Helpers\Docusign\Valley\templates\AutomatedServicesChecklist;
    use App\Helpers\Docusign\Valley\templates\AutoPaymentForm;
    use App\Helpers\Docusign\Valley\templates\ConsumerCreditApplication;
    use App\Helpers\Docusign\Valley\templates\NoticeToOwner;
    use App\Helpers\Docusign\Valley\templates\ResponsiblePersonsList;
    
    class CommercialPacket extends Packet {
        public function setup(array $data) {
            $this->add(new AlarmServiceAgreement($this->api));
            if(array_key_exists('invoice', $data) && !$data['invoice']) {
                $this->add(new AutoPaymentForm($this->api));
            }
            $this->add(new ResponsiblePersonsList($this->api));
            $this->add(new ConsumerCreditApplication($this->api));
            $this->add(new NoticeToOwner($this->api));
            $this->add(new AutomatedServicesChecklist($this->api));
        }
    }
