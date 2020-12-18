<?php
    
    namespace App\Helpers\Docusign\Valley\packets;
    
    use App\Helpers\Docusign\Packet;
    use App\Helpers\Docusign\Valley\templates\AlarmServiceAgreement;
    use App\Helpers\Docusign\Valley\templates\NoticeToOwner;
    
    class NoRMRPacket extends Packet {
        public function setup(array $data) {
            $this->add(new AlarmServiceAgreement($this->api));
            $this->add(new NoticeToOwner($this->api));
        }
    }
