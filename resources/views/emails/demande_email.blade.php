@component('mail::message')

    Bonjour,

    Une demande de véhicule pour la mission "{{strtoupper($mission->objet)}}" vous a été envoyé en tant que valideur.
    Veillez vous connecter pour la validation.

    -----------------------------------------------------------
        Rédacteur :  {{ $mission->dmdeur->agent->nom }} {{ $mission->dmdeur->agent->prenom }}
        Période   :  {{ $mission->dateDepart->format('d/m/Y') }} - {{ $mission->dateRetour->format('d/m/Y') }}
        Trajet    :  {{ $mission->villeDep->nom }} - {{ $mission->villeDesti->nom }}
    -----------------------------------------------------------
    Merci,
    {{ config('app.name') }} (SOFITEX)
@endcomponent
