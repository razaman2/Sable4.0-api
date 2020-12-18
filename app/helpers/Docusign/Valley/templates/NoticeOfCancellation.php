<?php
    
    namespace App\Helpers\Docusign\Valley\templates;
    
    use App\Helpers\Docusign\Template;
    use Carbon\Carbon;
    
    class NoticeOfCancellation extends Template {
        protected $sequence = 3;
        
        protected $name = 'Notice of Cancellation';
        
        protected function dateOfTransaction() {
            $date = explode(' ', Carbon::parse()->isoFormat('MMMM Do YY'));
            $this->new('text_tabs')->setTabLabel("transaction month/day")->setValue("{$date[0]} {$date[1]}");
            $this->new('text_tabs')->setTabLabel("transaction year")->setValue($date[2]);
        }
    
        protected function latestCancellationDate() {
            $date = explode(' ', Carbon::parse()->addDays(3)->isoFormat('MMMM Do YY'));
            $this->new('text_tabs')->setTabLabel("latest cancellation month/day")->setValue("{$date[0]} {$date[1]}");
            $this->new('text_tabs')->setTabLabel("latest cancellation year")->setValue($date[2]);
        }
    
        protected function acknowledgedDate() {
            $date = explode(' ', Carbon::parse()->isoFormat('MMMM Do YY'));
            $this->new('text_tabs')->setTabLabel("acknowledged month/day")->setValue("{$date[0]} {$date[1]}");
            $this->new('text_tabs')->setTabLabel("acknowledged year")->setValue($date[2]);
        }
    
        protected function cancelledDate() {
            $date = explode(' ', Carbon::parse()->isoFormat('MMMM Do YY'));
            $this->new('text_tabs')->setTabLabel("cancelled month/day")->setValue("{$date[0]} {$date[1]}");
            $this->new('text_tabs')->setTabLabel("cancelled year")->setValue($date[2]);
        }
        
        public function build(array $data) : array {
            $this->dateOfTransaction();
            $this->latestCancellationDate();
            $this->acknowledgedDate();
            $this->cancelledDate();
            
            return parent::build($data);
        }
    }
