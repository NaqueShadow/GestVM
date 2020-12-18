@extends('layouts.respPool')

@section('content')


    <div class="card mt-5 align-content-center text-dark" style="height: 500px; color: #284563; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">

        <h5 class="text-success text-center"> Tous les véhicules </h5>

        <div class="card-body row" style="">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Dernier retour</th>
                    <th scope="col">Nbre mission</th>
                    <th scope="col">Statut</th>
                </tr>
                </thead>
                <tbody id="">
                @foreach( $vehicules as $vehicule )
                    <tr>
                        <td>{{ $vehicule->code }}</td>
                        <td>{{ $vehicule->modele }}</td>
                        <td>
                            @isset($vehicule->chauffeur->nom)
                                {{ $vehicule->chauffeur->nom }} {{ $vehicule->chauffeur->prenom }}
                            @endisset</td>
                        <td>{{ $vehicule->dernierRetour }}</td>
                        <td>{{ $vehicule->attributions_count }}</td>
                        <td>{{ $vehicule->statut }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>



@endsection
