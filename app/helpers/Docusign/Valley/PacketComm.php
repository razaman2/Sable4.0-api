<?php
    
    namespace App\Helpers\Docusign\Valley;

    use App\Helpers\Docusign\BaseDocument;

    class PacketComm extends BaseDocument
    {
        protected $documents = [
            [ServiceAgreementRMR::class, ['page' => 1]],
            [ServiceAgreementExt::class, ['page' => 2]],
            [AutomaticPayment::class, ['page' => 4]],
            [ResponsiblePersonsList::class, ['page' => 5]],
            [CreditApplication::class, ['page' => 6]],
            [NoticeToOwner::class, ['page' => 7]],
            [InstallationChecklist::class, ['page' => 8]],
        ];
    
        public function send($data = []) {
            $this->api->role('customer')
                ->setTabs($this->tabs($data))
                ->setName($data['name'])
                ->setEmail($data['email']);
            
            return $this->api->send($this->template('commercial')->getTemplateId());
        }
    }
