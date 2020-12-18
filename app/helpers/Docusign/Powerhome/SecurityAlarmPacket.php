<?php
    
    namespace App\Helpers\Docusign\Powerhome;
    
    use App\Helpers\Docusign\BaseDocument;

    class SecurityAlarmPacket extends BaseDocument
    {
        protected $documents = [
            [AlarmMonitoringAgreement::class, ['page' => 1]],
            [NoticeOfCancellation::class, ['page' => 3]],
            [InstallationAgreement::class, ['page' => 4]],
        ];
    
        public function send($data = []) {
            $this->api->role('customer')
                ->setTabs($this->tabs($data))
                ->setName("{$data['signers'][0]['firstName']} {$data['signers'][0]['lastName']}")
                ->setEmail($data['signers'][0]['email']);
        
            return $this->api->send($this->template('pht_alarm_agreement')->getTemplateId());
        }
    }
