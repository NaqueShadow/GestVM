<?php

namespace App\Mail;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Demande_email extends Mailable
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
        return $this->markdown('emails.demande_email')
            ->subject('Demande de validation d\'un besoin de véhicule pour la mission '. $this->mission->objet);
    }
}
