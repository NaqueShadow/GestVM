@extends('layouts.respPool')

@section('content')
    <div class="card mt-5 align-content-center text-dark" style="height: 500px; color: #284563; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">

        <h5 class="text-success text-center"> Tous les chauffeurs </h5>

        <div class="card-body row" style="">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Matricule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Nbre. mission</th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($chauffeurs as $chauffeur)
                    <tr>
                        <td>{{ $chauffeur->matricule }}</td>
                        <td>{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</td>
                        <td>{{ $chauffeur->telephone }}</td>
                        <td>{{ $chauffeur->vehicule->code }} </td>
                        <td>{{ $chauffeur->statut }}</td>
                        <td>{{ $chauffeur->attributions_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>

    </div>
@endsection
