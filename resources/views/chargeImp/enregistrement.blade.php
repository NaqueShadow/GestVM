@extends('layouts.chargeImp')

@section('content')

    <script>
        document.getElementById("enregistrement").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="height: 500px; color: #284563; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">

        <div class="card-header bg-light pt-0 pb-0">
            <h3>{{ $vehicule->code }}</h3>
            <div class="">
                <form class="" method="post" action="{{route('chargeImp.filtreMoisVehicule', ['vehicule' => $vehicule->code])}}" id="form">
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <div class="col"></div>
                        <input type="month" name="mois" required {{ isset($mois) ? 'value='.$mois : '' }} placeholder="mois" class="col-4 form-control">
                        <button type="submit" id="submitForm" class="btn btn-outline-info col-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body row" style="">

            @if( $errors->any() )
                <div class="alert alert-danger text-center text-danger">
                    Erreur detectée lors de l'enregistrement, veillez réessayer..
                </div>
            @endif

            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">DATE</th>
                    <th scope="col">UTILISATEUR</th>
                    <th scope="col">CHAUFFEUR</th>
                    <th scope="col" colspan="3">CONSOMMATION</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach( $attributions as $attribution )
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $attribution->mission->dateDepart->format('d/m') }} - {{ $attribution->mission->dateRetour->format('d/m/Y') }}</td>
                        <th>{{ $attribution->entite->designation }}</th>
                        <td>{{ $attribution->chauffeur->nom }} {{ $attribution->chauffeur->prenom }}</td>
                        @if(isset($attribution->ressource->id))
                            <td title="volume de carburant">{{ $attribution->ressource->carburant }} L</td>
                            <td title="compteur au depart">{{ $attribution->ressource->comptDepart }} Km</td>
                            <td title="compteur au retour">{{ $attribution->ressource->comptRetour }} Km</td>
                        @else
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        @endif
                        <td>
                            <button type="button" title="éditer" class="btn btn-info mt-1 mb-1" data-toggle="modal" data-target="#fenetre{{$attribution->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>
                            </button>
                            <div>
                                <div class="modal fade" id="fenetre{{$attribution->id}}" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form class="mt-5" method="post" action="{{route('chargeImp.storeRessource', ['vehicule' => $attribution->idVehicule])}}" id="form">
                                                    @csrf
                                                    @include('chargeImp.contenuModal')
                                                    <div class="col-12 ">
                                                    <button type="submit" id="submitForm" class="ml-auto btn btn-success mt-2" >Valider</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection

