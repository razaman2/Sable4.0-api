<?php

    namespace App\Notifications;

    use App\helpers\Email\EmailNotification;
    use App\helpers\Text\TextNotification;
    use App\Mail\DocusignAgreement as DocusignAgreementNotification;
    use DocuSign\eSign\Model\Signer;
    use Exception;
    use Helpers\Controllers\DocusignController;
    use Helpers\Text\Text;
    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Notification;
    use Illuminate\Support\Facades\Mail;

    class DocusignAgreement extends Notification
    {
        use Queueable;

        protected $signer, $viewer, $envelope, $status;

        protected $drivers = [
            'email' => EmailNotification::class,
            'phone' => TextNotification::class,
        ];

        /**
         * Create a new notification instance.
         * @return void
         */
        public function __construct($signers, $signer, $envelope) {
            $this->signer = $signer;
            $this->envelope = $envelope;

            /** @var Signer $signer */
            $this->viewer = array_reduce($signers->getSigners(), function($viewer, Signer $signer) {
                if($signer->getRoleName() === $this->signer['role']) {
                    $viewer = $signer;
                }

                return $viewer;
            });

            $this->status[$this->signer['id']] = [
                'role' => $this->signer['role'],
                'signed' => false
            ];
        }

        /**
         * Get the notification's delivery channels.
         * @param mixed $notifiable
         * @return array
         */
        public function via(DocusignController $notifiable) {
            return array_map(function($method) {
                return $this->drivers[$method];
            }, $notifiable->getNotificationMethods($this->signer));
        }

        /**
         * Get the mail representation of the notification.
         * @param mixed $notifiable
         * @return \Illuminate\Notifications\Messages\MailMessage
         */
        public function toMail(DocusignController $notifiable) {
            $status = Mail::to($this->signer['email'])
                ->send(new DocusignAgreementNotification(
                    $this->signer,
                    $notifiable->getPropertyAddress(),
                    $this->getViewingLink($notifiable->getSigningLink($this->envelope))
                    )
                );

            $this->status[$this->signer['id']]['email'] = is_null($status) ? $this->signer['email'] : false;
        }

        public function toText(DocusignController $notifiable) {
            try {
                $status = (new Text($this->signer['phone']))->send($this->getViewingLink($notifiable->getSigningLink($this->envelope)));
            } catch(Exception $e) {
                $status = false;
            } finally {
                $this->status[$this->signer['id']]['phone'] = preg_match('/queued/', $status) ? $this->signer['phone'] : false;
            }
        }

        /**
         * Get the array representation of the notification.
         * @param mixed $notifiable
         * @return array
         */
        public function toArray($notifiable) {
            return [//
            ];
        }

        public function getStatus($id) {
            return $this->status[$id];
        }

        protected function getViewingLink($link) {
            return "{$link}&role={$this->viewer->getRoleName()}";
        }
    }
