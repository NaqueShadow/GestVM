@extends('etatsVues.etatsVues')

@section('content')

    <div class=" align-content-center text-dark" >

        <div class="h4 text-center bg-light">Attribution de véhicule</div>

        <div class="mt-5 mb-3 text-black-50" style="border-bottom: 1px solid black;">Mission</div>

        <div class=" mt-4">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Objet :</td> <td class="">{{ $attribution->mission->objet }}</td>
                </tr>
            </table>
        </div>

        <div class=" mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Code activité :</td> <td class="">{{ $attribution->mission->idActivite ? $attribution->mission->activite->code:'-' }}</td>
                </tr>
            </table>
        </div>

        <div class=" mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Trajet :</td> <td class="">{{ $attribution->mission->villeDep->nom }} - {{ $attribution->mission->villeDesti->nom }}</td>
                </tr>
            </table>
        </div>

        <div class=" mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Délais :</td> <td class="">du {{ $attribution->mission->dateDepart->format('d/m/Y') }} au {{ $attribution->mission->dateRetour->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>

        <div class="mt-5 mb-3 text-black-50" style="border-bottom: 1px solid black;">Participants</div>

        <div class=" mt-4">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25"></td>
                </tr>
                @foreach($attribution->mission->agents as $agent)
                <tr>
                    <td class="w-25"></td>
                    <td class="">- ( {{ $agent->matricule }} )</td><td> {{ $agent->nom }} {{ $agent->prenom }}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <div class="mt-5 mb-3 text-black-50" style="border-bottom: 1px solid black;">Véhicule & chauffeur affectés</div>

        <div class="ml-5 mt-4">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Véhicule :</td> <td class="">{{ $attribution->idVehicule }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold"></td> <td class="">immatriculation => {{ $attribution->vehicule->immatriculation }}</td>
                </tr>

            </table>
        </div>

        <div class="ml-5 mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Chauffeur :</td> <td class="">( {{ $attribution->chauffeur->matricule }} )  {{ $attribution->chauffeur->nom }} {{ $attribution->chauffeur->prenom }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold w-25"></td> <td class="">contact => {{ $attribution->chauffeur->telephone }}</td>
                </tr>
            </table>
        </div>

        @if($attribution->mission->idEntite)
        <div class="mt-5 mb-5">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-50"></td>
                    <td class="text-black-50">{{ $attribution->mission->entite->designation }}</td>
                </tr>
            </table>
        </div>
        @endif

    </div>

@endsection
