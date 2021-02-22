@extends('etatsVues.etatsVues')

@section('content')

    <div class=" align-content-center text-dark" >

        <div class="h4 text-center bg-light">Demande de véhicule</div>
        <div class=" mt-5">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Mission :</td> <td class="">{{ $mission->objet }}</td>
                </tr>
            </table>
        </div>

        <div class=" mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Code activité :</td> <td class="">{{ $mission->idActivite ? $mission->activite->code:'-' }}</td>
                </tr>
            </table>
        </div>

        <div class=" mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Trajet :</td> <td class="">{{ $mission->villeDep->nom }} - {{ $mission->villeDesti->nom }}</td>
                </tr>
            </table>
        </div>

        <div class=" mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Depart :</td> <td class="">{{ $mission->dateDepart->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>

        <div class=" mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Retour :</td> <td class="">{{ $mission->dateRetour->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>

        <div class=" mt-3">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Valideur :</td> <td class="">{{ $mission->valideur->agent->nom }} {{ $mission->valideur->agent->prenom }}</td>
                </tr>
            </table>
        </div>


        @if(!empty($mission->typeV) || !empty($mission->codeV) || !empty($mission->idChauf))
            <div class="mt-5 text-black-50 w-25">[ Préférences ]</div>
        @endif
        @if(!empty($mission->typeV))
            <div class="ml-5 mt-2">
                <table class="w-100">
                    <tr>
                        <td class="font-weight-bold w-25">Type :</td> <td class="">Véhicule de {{$mission->typeV}}</td>
                    </tr>
                </table>
            </div>
        @endif
        @if(!empty($mission->codeV))
            <div class="ml-5 mt-3">
                <table class="w-100">
                    <tr>
                        <td class="font-weight-bold w-25">Véhicule :</td> <td class="">{{$mission->typeV}}</td>
                    </tr>
                </table>
            </div>
        @endif
        @if(!empty($mission->idChauf))
            <div class="ml-5 mt-3">
                <table class="w-100">
                    <tr>
                        <td class="font-weight-bold w-25">Chauffeur :</td> <td class="">{{ $mission->chauffeur->nom }} {{ $mission->chauffeur->prenom }} ({{ $mission->chauffeur->matricule }})</td>
                    </tr>
                </table>
            </div>
        @endif

        <div class=" mt-5">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-25">Participant(s) :</td>
                </tr>
                @foreach($mission->agents as $agent)
                <tr>
                    <td class="w-25"></td>
                    <td class="">- {{ $agent->nom }} {{ $agent->prenom }} ({{ $agent->matricule }})</td>
                </tr>
                @endforeach
            </table>
        </div>

        @isset($mission->commentaire)
            <div class=" mt-5">
                <table class="w-100">
                    <tr>
                        <td class="font-weight-bold w-25">Commentaire :</td> <td class="">{{ $mission->commentaire }}</td>
                    </tr>
                </table>
            </div>
        @endisset

        <div class=" mt-5 pt-5">
            <table class="w-100">
                <tr>
                    <td class="font-weight-bold w-50"></td>
                    <td class="text-black-50 text-right">{{ $mission->dmdeur->agent->nom }} {{ $mission->dmdeur->agent->prenom }},</td>
                </tr>
            </table>
        </div>

        @if($mission->idEntite)
            <div class=" mt-3">
                <table class="w-100">
                    <tr>
                        <td class="font-weight-bold w-50"></td>
                        <td class="text-right">{{ $mission->entite->designation }}</td>
                    </tr>
                </table>
            </div>
        @endif
    </div>

@endsection
