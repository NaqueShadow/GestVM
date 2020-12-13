@extends('layouts.agentMiss')

@section('content')

    <h3 class="text-dark text-center">Historique des demandes</h3>

    <a href="{{ route('mission.create') }}"><button type="button" class="btn btn-success mt-2 w-100" >Nouvelle requête</button></a>

    <hr>

    @foreach($missions as $mission)
    <div class="card mt-2 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 75%; height: auto">
        <div class="card-header bg-light text-success h4">
            <h5>{{$mission->objet}}</h5>
        </div>

        <div class="card-body row" style="color: #284563;">
            <div class="col-6">
                <div class="ml-5 mb-2">Trajet  : {{$mission->villeDep->nom}} - {{$mission->villeDesti->nom}}</div>
                <div class="ml-5 mb-2">Départ : {{$mission->dateDepart->format('d-m-Y')}}</div>
                <div class="ml-5 mb-0">Retour : {{$mission->dateRetour->format('d-m-Y')}}</div><br>
            </div>

            <div class="col-6">
                <div class="">  participants :</div>
                @foreach($mission->agents as $agent)
                <div class="ml-3 mt-2">   [ {{ $agent->matricule }} ] ... {{ $agent->nom }} {{ $agent->prenom }}</div>
                @endforeach
            </div>
            <div class="col-12"> {{ $agent->commentaire }} </div>

        </div>

        <div class="card-footer bg-light">
            <div>envoyé le {{ $mission->created_at->format('d F Y  à  H:i:s') }}</div>
        </div>
    </div>
    @endforeach

    </div>


@endsection
