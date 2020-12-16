<?php

    namespace Helpers\Docusign\VIO\packets;

    use Helpers\Docusign\Packet;
    use Helpers\Docusign\VIO\templates\NoticeOfAutoRenewal;
    use Helpers\Docusign\VIO\templates\NoticeOfCancellation;
    use Helpers\Docusign\VIO\templates\ScheduleOfProtection;
    use Helpers\Docusign\VIO\templates\SecuritySystemSaleAndServicesAgreement;

    class SecurityPacket extends Packet
    {
        public function setup(array $data) {
            $this->add(new SecuritySystemSaleAndServicesAgreement($this->api));
            $this->add(new ScheduleOfProtection($this->api));
            $this->add(new NoticeOfAutoRenewal($this->api));
            $this->add(new NoticeOfCancellation($this->api));
            //        $this->add(new AddendumToScheduleOfProtection($this->api));
            // TODO: Implement setup() method.
        }
    }
