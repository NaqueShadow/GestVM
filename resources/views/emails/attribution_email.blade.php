@component('mail::message')
# Reponse demande de véhicule

Bonjour,
Suite à votre demande de véhicule pour la mission _{{$attr->mission->objet}}_,
le véhicule {{$attr->idVehicule}}, immatriculation {{$attr->vehicule->immatriculation}} vous a été alloué
avec le chauffeur {{$attr->idChauf}}, matricule {{$attr->chauffeur->matricule}},
que vous pourrez jouindre au {{$attr->chauffeur->telephone}}

Merci,<br>
{{ config('app.name') }}
@endcomponent
