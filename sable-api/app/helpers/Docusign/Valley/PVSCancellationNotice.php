<?php
    
    namespace App\Helpers\Docusign\Valley;

    use Carbon\Carbon;

    class PVSCancellationNotice extends CancellationNotice 
    {
      protected function latestCancellationDate() {
        $date = explode(' ', Carbon::parse()->addDays(3)->isoFormat('MMMM Do YY'));
        $this->new('text_tabs')
            ->setTabLabel("{$this->config['name']}-latest-cancellation-date")
            ->setXPosition(230)
            ->setYPosition(377)
            ->setLocked(true)
            ->setValue("{$date[0]} {$date[1]}");

        $this->new('text_tabs')
            ->setTabLabel("{$this->config['name']}-latest-cancellation-year")
            ->setXPosition(345)
            ->setYPosition(377)
            ->setLocked(true)
            ->setValue($date[2]);
    }
    
    }