@extends('layouts.chargeImp')

@section('content')

    <script>
        document.getElementById("consommation").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="height: 500px; color: #284563; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="row mb-0">

                <div class="col">
                    <form class="p-0" method="post" action="{{route('chargeImp.filtreMois')}}" id="form">
                        @csrf
                        <div  class="form-group form-row mb-0">
                            <div class="col"></div>
                            <input type="month" name="mois" required {{ isset($mois) ? 'value='.$mois : '' }} placeholder="mois" class="col-3 form-control">
                            <button type="submit" id="submitForm" class="btn btn-outline-info col-1" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body row" style="">
            <div class="row col-12">
                <div class="col"></div>
                <form class="p-0" method="post" action="{{ route('chargeImp.rapport') }}" id="form">
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <div class="col"></div>
                        <input type="hidden" name="mois" required {{ isset($mois) ? 'value='.$mois : '' }}>
                        <button type="button" title="exporter" class="btn btn-outline-primary  mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                            </svg> Xslx
                        </button>
                    </div>
                </form>
            </div>

            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">DATE</th>
                    <th scope="col">UTILISATEUR</th>
                    <th scope="col">VEHICULE</th>
                    <th scope="col">CHAUFFEUR</th>
                    <th scope="col">CARBURANT</th>
                    <th scope="col">DISTANCE</th>
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
                        <td>{{ $attribution->idVehicule }}</td>
                        <td>{{ $attribution->chauffeur->nom }} {{ $attribution->chauffeur->prenom }}</td>
                        @if(isset($attribution->ressource->id))
                            <td title="volume de carburant">{{ $attribution->ressource->carburant }} L</td>
                            <td title="compteur au depart">{{ $attribution->ressource->comptRetour - $attribution->ressource->comptDepart }} Km</td>
                        @else
                            <td>-</td>
                            <td>-</td>
                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <div>
        <div class="modal fade" id="fenetre" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="mt-5" method="post" action="{{route('chargeImp.storeRessource', ['vehicule' => $attribution->idVehicule])}}" id="form">
                            @csrf

                            <div class="col-12 ">
                                <button type="submit" id="submitForm" class="ml-auto btn btn-success mt-2" >Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

