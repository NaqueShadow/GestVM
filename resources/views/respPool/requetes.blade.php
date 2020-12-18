@extends('layouts.respPool')

@section('content')

    <div class="collapse navbar-collapse mt-5" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="/">Requêtes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Historique</a>
            </li>

        </ul>
    </div>

    <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
        <div class="card-header bg-light text-success h4">
            <h5 class="text-center text-success"> Missions en cours </h5>
        </div>

        <div class="card-body row" style="color: #284563;">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Mission</th>
                    <th scope="col">Depart</th>
                    <th scope="col">Retour</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($attributions as $attribution)
                    <tr>
                        <td> {{$attribution->mission->objet}} </td>
                        <td> {{$attribution->mission->dateDepart}} </td>
                        <td> {{$attribution->mission->dateRetour}} </td>
                        <td> {{$attribution->mission->villeDest}} </td>
                        <td> {{$attribution->idVehicule}} </td>
                        <td> {{$attribution->chauffeur->nom}} {{$attribution->chauffeur->prenom}} </td>
                        <td>
                            <button class="btn btn-danger p-2" title="mission annulée">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                            <button class="btn btn-info p-2" title="mission terminée">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
        <div class="card-header bg-light text-success h4">
            <h5 class="text-center text-success"> Requêtes en attentes de traitement </h5>
        </div>

        <div class="card-body row" style="color: #284563;">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Demandeur</th>
                    <th scope="col">Mission</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Depart</th>
                    <th scope="col">Retour</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($missions as $mission)
                    <tr>
                        <td> {{$mission->dmdeur->agent->nom}} {{$mission->dmdeur->agent->prenom}} </td>
                        <td> {{$mission->objet}} </td>
                        <td> {{$mission->villeDesti->nom}} </td>
                        <td> {{$mission->dateDepart->format('d-m-Y')}} </td>
                        <td> {{$mission->dateRetour->format('d-m-Y')}} </td>
                        <td>
                            <button class="btn btn-danger p-2" title="ouvrir">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>






@endsection
