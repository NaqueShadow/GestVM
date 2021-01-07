@extends('layouts.agentMiss')

@section('content')

    <script>
        document.getElementById("reponses").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center" style="box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; height: auto">

        <div class="card-header bg-light ">
            <span class="text-black-50">_{{$attribution->created_at->format('d M Y')}}_</span>
            <span class="text-dark ml-3 h5">{{$attribution->mission->objet}}</span>
        </div>

        <div class="card-body row" style="color: #284563;">
            <div class="col-6 pl-5">
                <table>
                    <tr>
                        <td>Véhicule</td> <td class="text-info h5">    : {{$attribution->idVehicule}}</td>
                    </tr>
                    <tr>
                        <td>Immaticulation</td> <td class="text-info h5">  : {{$attribution->vehicule->immatriculation}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-6 pl-5">
                <table>
                    <tr>
                        <td>Chauffeur</td> <td class="text-info h5">:   {{$attribution->chauffeur->nom}} {{$attribution->chauffeur->prenom}}</td>
                    </tr>
                    <tr>
                        <td>Matricule</td> <td class="text-info h5">:   {{$attribution->idChauf}}</td>
                    </tr>
                    <tr>
                        <td>Contact</td> <td class="text-info h5">:   {{$attribution->chauffeur->telephone}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="{{ route('agentMiss.reponse') }}">
            <button type="submit" id="submitForm" class="btn btn-outline-dark m-2" style="">Retour</button>
        </a>

    </div>




@endsection
