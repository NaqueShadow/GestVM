@extends('layouts.chefGarage')

@section('content')

    <script>
        document.getElementById("vehicule").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center" style="box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; height: auto">

        @if( session()->get('passError') )
            <div class="alert alert-danger mt-3 text-center text-danger alert-dismissible fade show" role="alert">
                {{ session()->get('passError') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif {{ session()->get('passError') }}

        <div class="card-body row" style="color: #284563;">
            <div class="col-6 pl-5">
                <table class="table table-responsive">
                    <tr>
                        <td>code véhicule</td> <td class="text-info h5">     {{$vehicule->code}}</td>
                    </tr>
                    <tr>
                        <td>Modèle</td> <td class="text-info h5">     {{$vehicule->modele}}</td>
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
                    <div class="text-dark mt-5 font-weight-bold">Véhicule sans chauffeur affecté</div>
                @endif
            </div>

            <div class="col-12 " style="">
                <table class="table ">
                    <tr class="table-dark">
                        <td></td> <td class="">Numéro</td> <td class="">Etablit le</td> <td class="">Expire le</td> <td class="">Lieu</td>
                    </tr>
                    <tr>
                        <th class="t">Visite technique</th>
                        <td class="text-info h6">{{isset($doc2->numero) ? $doc2->numero : '--'}}</td>
                        <td class="text-info h6">{{isset($doc2->numero) ? $doc2->etabl->format('d/m/Y') : '--'}}</td>
                        <td class="text-info h6">{{isset($doc2->numero) ? $doc2->exp->format('d/m/Y') : '--'}}</td>
                        <td class="text-info h6">{{isset($doc2->numero) ? $doc2->lieu : '--'}}</td>
                    </tr>
                    <tr>
                        <th>Assurance</th>
                        <td class="text-info h6">{{isset($doc1->numero) ? $doc1->numero : '--'}}</td>
                        <td class="text-info h6">{{isset($doc1->numero) ? $doc1->etabl->format('d/m/Y') : '--'}}</td>
                        <td class="text-info h6">{{isset($doc1->numero) ? $doc1->exp->format('d/m/Y') : '--'}}</td>
                        <td class="text-info h6">{{isset($doc1->numero) ? $doc2->lieu : '--'}}</td>
                    </tr>
                    <tr>
                        <th>Carte grise</th>
                        <td class="text-info h6">{{isset($doc3->numero) ? $doc3->numero : '--'}}</td>
                        <td class="text-info h6">{{isset($doc3->numero) ? $doc3->etabl->format('d/m/Y') : '--'}}</td>
                        <td class="text-info h6">{{isset($doc3->numero) ? $doc3->exp->format('d/m/Y') : '--'}}</td>
                        <td class="text-info h6">{{isset($doc3->numero) ? $doc2->lieu : '--'}}</td>
                    </tr>
                </table>
            </div>

        </div>

        <a href="{{ route('chefGarage.liste_vehicules') }}">
            <button type="submit" id="submitForm" class="btn btn-outline-dark m-2" style="">Retour</button>
        </a>

    </div>




@endsection
