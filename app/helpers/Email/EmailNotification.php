<?php
    namespace App\helpers\Email;

    use Illuminate\Notifications\Notification;

    class EmailNotification
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
            $notification->toMail($notifiable);
        }
    }
