<?php

namespace App\Listeners;

use App\Mail\Demande_email;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class Demande_listener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->mission->idValideur && $event->mission->valideur->agent->email) {
            $valideur = $event->mission->valideur->agent->email;
            Mail::to($valideur)->send(new Demande_email($event->mission));
        }
    }
}
