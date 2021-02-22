@component('mail::message')

    Bonjour,

    Une demande de véhicule pour la mission "{{strtoupper($mission->objet)}}" vous a été envoyé en tant que responsable du pool "{{ $mission->pool->designation }}".
    Veillez vous connecter pour repondre à la demande.

    -----------------------------------------------------------
        Rédacteur      : {{ $mission->dmdeur->agent->nom }} {{ $mission->dmdeur->agent->prenom }}
        Valideur       : {{ $mission->valideur->agent->nom }} {{ $mission->valideur->agent->prenom }}
        Période        : {{ $mission->dateDepart->format('d/m/Y') }} - {{ $mission->dateRetour->format('d/m/Y') }}
        Trajet         : {{ $mission->villeDep->nom }} - {{ $mission->villeDesti->nom }}
        Code activité  : {{ $mission->activite->designation }}
        Service/Entité : {{ $mission->entite->designation }}
    -----------------------------------------------------------
    Merci,
    {{ config('app.name') }} (SOFITEX)
@endcomponent
