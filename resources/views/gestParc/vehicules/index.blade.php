@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("vehicules").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="height: 500px; color: #284563; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{route('gestParc.rechercheVehicule')}}" id="form">
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <div class="col"></div>
                        <input type="search" name="text" required {{ isset($text) ? 'value='.$text : '' }} placeholder="recherche" class="col-4 form-control">
                        <button type="submit" id="submitForm" class="btn btn-outline-info col-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body" style="color: #284563;">
            @if( session()->get('info') )
                <div class="alert alert-success text-center text-success">
                    {{ session()->get('info') }}
                </div>
            @endif
            @if( $errors->any() )
                <div class="alert alert-danger text-center text-danger">
                    Une mauvaise donnée a été saisie cliquez sur le bouton pour réessayer..
                </div>
            @endif

            <button type="button" class="btn btn-success mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                + Nouveau
            </button>

            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Acquisition</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Affectation</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach( $vehicules as $vehicul )
                    <tr>
                        <th>{{ ++$i }}</th>
                        <th>{{ $vehicul->code }}</th>
                        <td>{{ $vehicul->modele }}</td>
                        <td>{{ $vehicul->acquisition ? $vehicul->acquisition->format('d/m/Y'):''}}</td>
                        <td>
                            {{ isset($vehicul->chauffeur->nom) ? $vehicul->chauffeur->nom.' '.$vehicul->chauffeur->prenom : '--' }}
                        </td>
                        <td>{{ $vehicul->pool->abbreviation }}</td>
                        <td>
                            <a href="{{route('vehicule.fullShow', ['vehicule' => $vehicul->code])}}">
                                <button class="btn btn-info p-1">
                                    ouvrir
                                </button>
                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <div>
        <div class="modal fade" id="fenetre" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enregistrement d'un nouveau véhicule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form class="mt-5" method="post" action="{{route('vehicule.store')}}" id="form">

                            @csrf
                            <div class="align-items-center">

                                <fieldset>
                                    <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
                                        <legend></legend>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Code véhicule</label>
                                            <div class="col-9">
                                            <input type="text" name="code" id="code" value="{{ old('code') ?? $vehicule->code }}" required placeholder="..." value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror">
                                            @error('code')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'trop court' }}
                                                </div>
                                            @enderror
                                            </div>
                                        </div>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Immatriculation</label>
                                            <div class="col-9">
                                            <input type="text" name="immatriculation" id="immatriculation" value="{{ old('immatriculation') ?? $vehicule->immatriculation }}" required placeholder="..." value="{{ old('immatriculation') }}" class="form-control @error('immatriculation') is-invalid @enderror">
                                            @error('immatriculation')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'trop court' }}
                                                </div>
                                            @enderror
                                            </div>
                                        </div>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Modèle</label>
                                            <div class="col-9">
                                            <input type="text" name="modele" id="modele" value="{{ old('modele') ?? $vehicule->modele }}" required placeholder="..." value="{{ old('modele') }}" class="form-control @error('modele') is-invalid @enderror">
                                            @error('modele')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'trop court' }}
                                                </div>
                                            @enderror
                                            </div>
                                        </div>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Acquisition</label>
                                            <div class="col-9">
                                            <input type="date" name="acquisition" id="acquisition" value="{{ old('acquisition') ?? $vehicule->code }}" required placeholder="..." value="{{ old('acquisition') }}" class="form-control @error('acquisition') is-invalid @enderror">
                                            @error('acquisition')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'entrez une date d\'avant aujourd\'hui' }}
                                                </div>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                            </div>

                            <button type="submit" id="submitForm" class="btn btn-success mt-2" >Enregistrer</button>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <small></small>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection