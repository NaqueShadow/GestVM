@extends('layouts.agentMiss')

@section('content')

    <script>
        document.getElementById("reponses").style.backgroundColor = "white";
    </script>

    <div class="mt-3 ml-5 mr-5 row align-content-center">
        <div class="col"></div>
        <div class="col-auto">
            <form method="post" action="{{ route('pdf.attribution', ['attribution' => $attribution->id]) }}">
                @csrf
                <button type="submit" class="btn btn-link col-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-chat-text" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg> Pdf
                </button>
            </form>
        </div>
    </div>
    <div class="card mt-2 align-content-center" style="box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; height: auto">

        <div class="card-header bg-light ">
            <span class="text-black-50">_{{$attribution->created_at->format('d M Y')}}_</span>
            <span class="text-dark ml-3 h5">{{$attribution->mission->objet}}</span>
        </div>

        <div class="card-body" style="color: #284563;">
            <div class="row mt-3">
                <div class="col-3 text-right font-weight-bold">Mission :</div>
                <div class="col-8 form-control text-center">{{ $attribution->mission->objet }}</div>
            </div>

            <div class="row mt-4">
                <div class="col-2"></div>
                <div class="col-3 text-right font-weight-bold">Véhicule :</div>
                <div class="col-4 form-control text-center">{{$attribution->idVehicule}}</div>
            </div>

            <div class="row mt-3">
                <div class="col-2"></div>
                <div class="col-3 text-right font-weight-bold">Immaticulation :</div>
                <div class="col-4 form-control text-center">{{$attribution->vehicule->immatriculation}}</div>
            </div>

            <div class="row mt-4">
                <div class="col-1"></div>
                <div class="col-3 text-right font-weight-bold">Chauffeur :</div>
                <div class="col-6 form-control text-center">{{$attribution->chauffeur->nom}} {{$attribution->chauffeur->prenom}}</div>
            </div>

            <div class="row mt-3">
                <div class="col-2"></div>
                <div class="col-3 text-right font-weight-bold">Matricule :</div>
                <div class="col-4 form-control text-center">{{$attribution->idChauf}}</div>
            </div>

            <div class="row mt-3">
                <div class="col-2"></div>
                <div class="col-3 text-right font-weight-bold">Contact :</div>
                <div class="col-4 form-control text-center">{{$attribution->chauffeur->telephone}}</div>
            </div>

        </div>

        <a href="{{ route('agentMiss.reponse') }}">
            <button type="submit" id="submitForm" class="btn btn-outline-dark m-2" style="">Retour</button>
        </a>

    </div>




@endsection
