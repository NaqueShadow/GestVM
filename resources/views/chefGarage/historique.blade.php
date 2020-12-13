@extends('layouts.chefGarage')

@section('content')

    <div class="col-12" style="">


        <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
            <div class="card-header bg-light text-success h4">
                <h5 class="text-success text-center">Historique des interventions enregistrées</h5>
            </div>

            <div class="card-body row" style="color: #284563;">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vehicule</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Début</th>
                        <th scope="col">Fin prévisionnelle</th>
                        <th scope="col">Fin réelle</th>
                    </tr>
                    </thead>
                    <tbody id="">
                    @foreach($interventions as $intervention)
                        <tr>
                            <th scope="row"></th>
                            <td>{{ $intervention->idVehicule }}</td>
                            <td>{{ $intervention->type }}</td>
                            <td>{{ $intervention->debut }}</td>
                            <td>{{ $intervention->finPrev }}</td>
                            <td>{{ $intervention->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
