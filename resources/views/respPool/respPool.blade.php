@extends('layouts.respPool')

@section('content')

    <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
        <div class="card-header bg-light text-success h4">
            <h5 class="text-center text-success"> Missions en cours </h5>
        </div>

        <div class="card-body row" style="color: #284563;">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Retour</th>
                </tr>
                </thead>
                <tbody id="">

                    <tr>
                        <th scope="row"></th>
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
        <div class="col-6">
            <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
                <div class="card-header bg-light text-success h4">
                    <h5 class="text-success text-center"> Chauffeurs disponibles </h5>
                </div>

                <div class="card-body row" style="color: #284563;">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Matricule</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                        </tr>
                        </thead>
                        <tbody id="">

                        <tr>
                            <th scope="row"></th>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                        </tr>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <div class="col-6">
            <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
                <div class="card-header bg-light text-success h4">
                    <h5 class="text-success text-center"> Véhicules disponibles </h5>
                </div>

                <div class="card-body row" style="color: #284563;">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Code</th>
                            <th scope="col">Modèle</th>
                            <th scope="col">Dernier retour</th>
                        </tr>
                        </thead>
                        <tbody id="">

                        <tr>
                            <th scope="row"></th>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>

                        </tr>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>

    <div class="col-6" style="margin-left: 25%;">
        <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
            <div class="card-header bg-light text-success h4">
                <h5 class="text-success text-center">Vehicules immobilisés</h5>
            </div>

            <div class="card-body row" style="color: #284563;">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vehicule</th>
                        <th scope="col">Début</th>
                        <th scope="col">Fin</th>
                        <th scope="col">Motif</th>
                    </tr>
                    </thead>
                    <tbody id="">

                    <tr>
                        <th scope="row"></th>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </div>




@endsection
