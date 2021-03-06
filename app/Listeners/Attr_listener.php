<?php

namespace App\Listeners;

use App\Helpers\Sms;
use App\Mail\Attr_email;
use App\Models\Chauffeur;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class Attr_listener
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
        //email au demandeur
        if ($event->attr->mission->demandeur && $event->attr->mission->dmdeur->agent->email) {
            $demandeur = $event->attr->mission->dmdeur->agent->email;
            if ($event->attr->mission->idValideur && $event->attr->mission->valideur->agent->email) {
                $valideur = $event->attr->mission->valideur->agent->email;
                Mail::to($demandeur)->cc($valideur)->send(new Attr_email($event->attr));
            }
            else
            Mail::to($demandeur)->send(new Attr_email($event->attr));
        }
        elseif ($event->attr->mission->idValideur && $event->attr->mission->valideur->agent->email)
        {
            $valideur = $event->attr->mission->valideur->agent->email;
            Mail::to($valideur)->send(new Attr_email($event->attr));
        }

        /*
        SMS au chauffeur
        $chauffeur = Chauffeur::find($event->attr->idChauf)->telephone;
        $msg = 'Nouvelle mission
                Vehicule : '.$event->attr->idVehicule.'
                Depart : '.$event->attr->mission->dateDepart.'
                Retour : '.$event->attr->mission->dateRetour.'
                Trajet : '.$event->attr->mission->villeDepart.' '.$event->attr->mission->villeDesti->nom;

        Sms::sendSMSFonction($chauffeur, $msg);
        */

    }
}
