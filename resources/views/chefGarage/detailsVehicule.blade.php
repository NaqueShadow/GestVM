@extends('layouts.chefGarage')

@section('content')

    <script>
        document.getElementById("vehicule").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center" style="box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; height: auto">

        <div class="card-body row" style="color: #284563;">
            <div class="col-6 pl-5">
                <table class="table table-responsive">
                    <tr>
                        <td>code véhicule</td> <td class="text-info h5">     {{$vehicule->code}}</td>
                    </tr>
                    <tr>
                        <td>Modele</td> <td class="text-info h5">     {{$vehicule->modele}}</td>
                    </tr>
                    <tr>
                        <td>Immaticulation</td> <td class="text-info h5">   {{$vehicule->immatriculation}}</td>
                    </tr>
                </table>
            </div>

            <div class="col-6 pl-5">
                @if( isset($vehicule->chauffeur->nom) )
                    <table class="table table-responsive">
                        <tr>
                            <td>Chauffeur</td> <td class="text-info h5">:   {{$vehicule->chauffeur->nom}} {{$vehicule->chauffeur->prenom}}</td>
                        </tr>
                        <tr>
                            <td>Matricule</td> <td class="text-info h5">:   {{$vehicule->idChauf}}</td>
                        </tr>
                        <tr>
                            <td>Contact</td> <td class="text-info h5">:   {{$vehicule->chauffeur->telephone}}</td>
                        </tr>
                    </table>
                @else
                    <div class="text-dark mt-5">Véhicule sans chauffeur affecté</div>
                @endif
            </div>

            <div class="col-6 pl-5 " style="margin-left: 25%;">
                <table class="table table-responsive">
                    <tr>
                        <td></td> <td class="">code</td> <td class="">établit le</td> <td class="">expire le</td>
                    </tr>
                    <tr>
                        <th class="t">Visite technique</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                    <tr>
                        <th>Assurance</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                    <tr>
                        <th>Carte grise</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                </table>
            </div>

        </div>

        <a href="{{ route('chefGarage.liste_vehicules') }}">
            <button type="submit" id="submitForm" class="btn btn-outline-dark m-2" style="">Retour</button>
        </a>

    </div>




@endsection
