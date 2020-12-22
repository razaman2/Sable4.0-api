<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class DocusignAgreement extends Mailable
    {
        use Queueable, SerializesModels;

        public $subject = 'Your Agreement.';
        public $signer, $property, $link;

        /**
         * Create a new message instance.
         * @return void
         */
        public function __construct($signer, $property, $link) {
            $this->signer = $signer;
            $this->property = $property;
            $this->link = $link;
        }

        /**
         * Build the message.
         * @return $this
         */
        public function build() {
            return $this->html("
                <div>
                    <span>
                        <h5>{$this->signer['firstName']} {$this->signer['lastName']}</h5>
                    </span>
                </div>
                <p>
                    your agreement for the property located at {$this->property['address']['address1']}, {$this->property['address']['city']} is ready to be signed.
                </p>

                <div>
                    <a>{$this->link}</a>
                </div>

                Thank you."
            );
        }
    }
