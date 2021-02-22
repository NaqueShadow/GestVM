<?php

namespace App\Mail;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Validation_email extends Mailable
{
    use Queueable, SerializesModels;
    public $mission;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.validation_email')
            ->subject('Demande de véhicule pour la mission '. $this->mission->objet);
    }
}
