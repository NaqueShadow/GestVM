@extends('layouts.respPool')

@section('content')

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 col-md-12" >
            <div class="card mt-3 align-content-center text-dark" style="overflow-y: -moz-hidden-unscrollable; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
                <div class="card-header bg-light text-success h4">
                    <h5 class="text-success text-center">Chauffeurs en autorisation d'absence</h5>
                </div>

                <div class="card-body row" style="color: #284563;">

                    <table class="table table-success table-hover table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Chauffeur</th>
                            <th scope="col">Début</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Motif</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach($absences as $absence)
                            <tr>
                                <td>{{ $absence->idChauf }}</td>
                                <td>{{ $absence->debutAbs }}</td>
                                <td>{{ $absence->finAbs }}</td>
                                <td>{{ $absence->motif }}</td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 col-md-12" >
            <div class="card mt-3 align-content-center text-dark" style="overflow-y: -moz-hidden-unscrollable; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
                <div class="card-header bg-light text-success h4">
                    <h5 class="text-success text-center">Véhicules immobilisés</h5>
                </div>

                <div class="card-body row" style="color: #284563;">

                    <table class="table table-success table-hover table-striped">
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
                                <td>{{ $intervention->debut->format('d-m-Y') }}</td>
                                <td>{{ $intervention->finPrev->format('d-m-Y') }}</td>
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
