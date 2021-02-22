<?php

namespace App\Listeners;

use App\Mail\Validation_email;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class Validation_listener
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
        if ($event->mission->pool->users && $event->mission->pool->users[0]->agent->email) {
            $valideur = $event->mission->pool->users[0]->agent->email;
            Mail::to($valideur)->send(new Validation_email($event->mission));
        }
    }
}
