@component('mail::message')

    Bonjour,

    Suite à votre demande de véhicule pour la mission "{{strtoupper($attr->mission->objet)}}",
    les éléments suivants vous ont été attribués:

    -----------------------------------------------------------
        Véhicule  :   {{$attr->idVehicule}},
            Immatriculation {{$attr->vehicule->immatriculation}}

        Chauffeur :   {{$attr->chauffeur->nom}} {{$attr->chauffeur->prenom}},
            Matricule : {{$attr->chauffeur->matricule}},
              Contact : {{$attr->chauffeur->telephone}}
    -----------------------------------------------------------
    Merci,
    {{ config('app.name') }} (SOFITEX)
@endcomponent
