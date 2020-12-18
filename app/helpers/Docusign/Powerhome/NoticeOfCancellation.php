<?php
    
    namespace App\Helpers\Docusign\Powerhome;
    
    use App\Helpers\Docusign\Interfaces\Defaultable;
    use App\Helpers\Docusign\TemplateTabs;

    class NoticeOfCancellation extends TemplateTabs implements Defaultable {
        public function config($properties = []) {
            return parent::config(array_merge($properties, [
                'name' => 'Notice of Cancellation',
            ]));
        }
        
        protected function dealer($data) {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-Dealer")
                ->setXPosition(55)
                ->setYPosition(133)
                ->setLocked(true)
                ->setValue($data);
        }
        
        protected function customerName() {
            $customerName = preg_match("/residential/i", $this->data['property']['type']) ?
                join(' ', [$this->data['signers'][0]['firstName'], $this->data['signers'][0]['lastName']]) :
                $this->data['companyName'];
            
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-CustomerName")
                ->setXPosition(282)
                ->setYPosition(133)
                ->setLocked(true)
                ->setValue($customerName);
        }
        
        protected function dateOfTransaction() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-DateOfTransaction")
                ->setXPosition(509)
                ->setYPosition(133);
        }
        
        protected function cancellationCheckbox() {
            $this->new('checkbox_tabs')
                ->setTabLabel("{$this->config['name']}-CancellationCheckbox")
                ->setXPosition(32)
                ->setYPosition(313)
                ->setLocked(false);
        }
        
        protected function cancellationSignature() {
            $this->new('sign_here_tabs')
                ->setTabLabel("{$this->config['name']}-CancellationSignature")
                ->setConditionalParentLabel("{$this->config['name']}-CancellationCheckbox")
                ->setConditionalParentValue('on')
                ->setXPosition(300)
                ->setYPosition(275);
        }
        
        protected function cancellationDate() {
            $this->new('date_signed_tabs')
                ->setTabLabel("{$this->config['name']}-CancellationDate")
                ->setName("{$this->config['name']}-CancellationSignature")
                ->setConditionalParentLabel("{$this->config['name']}-CancellationCheckbox")
                ->setConditionalParentValue('on')
                ->setXPosition(487)
                ->setYPosition(313);
        }
        
        protected function propertyAddress() {
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PropertyAddress")
                ->setXPosition(165)
                ->setYPosition(278)
                ->setLocked(true)
                ->setValue(join(', ', [$this->data['property']['address1'], $this->data['property']['address2']]));
    
            $this->new('text_tabs')
                ->setTabLabel("{$this->config['name']}-PropertyCityStateZip")
                ->setXPosition(165)
                ->setYPosition(287)
                ->setLocked(true)
                ->setValue(join(', ', [$this->data['property']['city'], $this->data['property']['state'], $this->data['property']['zip']]));
        }
        
        protected function finalCancellationDate() {
            $this->new('formula_tabs')
                ->setTabLabel("{$this->config['name']}-FinalCancellationDate")
                ->setFormula("AddDays([{$this->config['name']}-DateOfTransaction], 3)")
                ->setXPosition(564)
                ->setYPosition(280);
        }
    
        public function loadDefaults() {
            $this->dateOfTransaction();
            $this->cancellationCheckbox();
            $this->cancellationSignature();
            $this->cancellationDate();
            $this->dealer(request()->input('company.name'));
            $this->customerName();
            $this->propertyAddress();
            $this->finalCancellationDate();
        }
    }
