<?php

namespace App\Mail;

use App\Models\Attribution;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Attr_email extends Mailable
{
    use Queueable, SerializesModels;

    public $attr;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Attribution $attribution)
    {
        $this->attr = $attribution;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.attribution_email')
            ->subject('Affectation de véhicule pour la mission '. $this->attr->mission->objet);
    }
}
