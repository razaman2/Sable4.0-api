<?php
    namespace App\helpers\Text;

    use Illuminate\Notifications\Notification;

    class TextNotification
    {
        /**
         * Send the given notification.
         *
         * @param  mixed  $notifiable
         * @param  \Illuminate\Notifications\Notification  $notification
         * @return void
         */
        public function send($notifiable, Notification $notification)
        {
            $notification->toText($notifiable);
        }
    }
