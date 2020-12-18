@extends('layouts.chefGarage')

@section('content')

    <div class="col-12" style="">


        <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
            <div class="card-header bg-light text-success h4">
                <h5 class="text-success text-center">Listes des véhicules enregistrés</h5>
            </div>

            <div class="card-body row" style="color: #284563;">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Véhicule</th>
                        <th scope="col">Modèle</th>
                        <th scope="col">Chauffeur</th>
                        <th scope="col">Contact</th>
                    </tr>
                    </thead>
                    <tbody id="">
                    @foreach($vehicules as $vehicule)
                        <tr>
                            <th scope="row"></th>
                            <td>{{ $vehicule->code }}</td>
                            <td>{{ $vehicule->modele }}</td>
                            <td> @if(isset($vehicule->chauffeur->nom)) {{ $vehicule->chauffeur->nom }} {{ $vehicule->chauffeur->prenom }} @endif</td>
                            <td> @if(isset($vehicule->chauffeur->telephone)) {{ $vehicule->chauffeur->telephone }} @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
