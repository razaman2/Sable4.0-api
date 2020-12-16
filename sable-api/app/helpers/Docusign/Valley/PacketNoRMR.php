<?php
    
    namespace App\Helpers\Docusign\Valley;
    
    use App\Helpers\Docusign\BaseDocument;

    class PacketNoRMR extends BaseDocument
    {
        protected $documents = [
            [ServiceAgreement::class, ['page' => 1]],
            [ServiceAgreementExt::class, ['page' => 2]],
            [NoticeToOwner::class, ['page' => 4]]
        ];
    
        public function send($data = []) {
            $this->api->role('customer')
                ->setTabs($this->tabs($data))
                ->setName($data['name'])
                ->setEmail($data['email']);
        
            return $this->api->send($this->template('no_rmr')->getTemplateId());
        }
    }
