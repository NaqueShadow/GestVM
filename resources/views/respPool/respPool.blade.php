@extends('layouts.respPool')

@section('content')

    <div class="card mt-5 align-content-center text-dark" style="overflow: scroll -moz-scrollbars-none; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
        <div class="card-header bg-light text-success h4">
            <h5 class="text-center text-success"> Missions en cours </h5>
        </div>

        <div class="card-body row" style="color: #284563;">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Retour</th>
                </tr>
                </thead>
                <tbody id="">

                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 col-md-12" >
            <div class="card mt-3 align-content-center text-dark" style="overflow-y: -moz-hidden-unscrollable; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
                <div class="card-header bg-light text-success h4">
                    <h5 class="text-success text-center">Véhicules immobilisés</h5>
                </div>

                <div class="card-body row" style="color: #284563;">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Vehicule</th>
                            <th scope="col">Début</th>
                            <th scope="col">Fin prévisionnelle</th>
                            <th scope="col">Maintenance</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach($interventions as $intervention)
                            <tr>
                                <td>{{ $intervention->idVehicule }}</td>
                                <td>{{ $intervention->debut }}</td>
                                <td>{{ $intervention->finPrev }}</td>
                                <td>{{ $intervention->type }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>

@endsection
