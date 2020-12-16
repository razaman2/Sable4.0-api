<?php
    
    namespace App\Helpers\Docusign\Valley;

    use App\Helpers\Docusign\BaseDocument;

    class PacketPVSResi extends BaseDocument
    {
        protected $documents = [
            [ServiceAgreementRMR::class, ['page' => 1]],
            [ServiceAgreementExt::class, ['page' => 2]],
            [AutomaticPayment::class, ['page' => 4, 'offsetY' => 33]],
            [ResponsiblePersonsList::class, ['page' => 5]],
            [CreditApplication::class, ['page' => 6]],
            [NoticeToOwner::class, ['page' => 7]],
            [PVSCancellationNotice::class, ['page' => 8]],
            [WaiverToCancel::class, ['page' => 9]],
            [InstallationChecklist::class, ['page' => 10]],
        ];
        
        public function send($data = []) {
            $this->api->role('customer')
                ->setTabs($this->tabs($data))
                ->setName($data['name'])
                ->setEmail($data['email']);
            
            return $this->api->send($this->template('pvs_residential')->getTemplateId());
        }
      
    }
