@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("pools").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="height: 500px; color: #284563; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{route('gestParc.recherchePool')}}" id="form">
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
                    <th scope="col">Pool</th>
                    <th scope="col">Abbréviation</th>
                    <th scope="col">Nbr véhicules</th>
                    <th scope="col">Nbr chauffeurs</th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach($pools as $p)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <th>
                            <a href="{{ route('pool.show', ['pool' => $p->id]) }}" class="text-dark">{{ $p->designation }}</a>
                        </th>
                        <td>{{ $p->abbreviation }}</td>
                        <td>{{ $p->vehicules_count }}</td>
                        <td>{{ $p->chauffeurs_count }}</td>
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Création d'un mini Pool</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form class="mt-5" method="post" action="{{route('pool.store')}}" id="form">

                            @csrf
                            <div class="align-items-center">

                                <fieldset>
                                    <div class="form-row"
                                         style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                                        <div class="form-group input-group col-12 row">
                                            <label class="col-3">Désignation</label>
                                            <div class="col-9">
                                                <input type="text" name="designation" id="designation"
                                                       value="{{ old('designation') ?? $pool->designation }}" required
                                                       placeholder="..." value="{{ old('designation') }}"
                                                       class="form-control @error('designation') is-invalid @enderror">
                                                @error('designation')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'désignation déjà existant' }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group input-group col-12 row">
                                            <label class="col-3">Abbréviation</label>
                                            <div class="col-9">
                                                <input type="text" name="abbreviation" id="abbreviation"
                                                       value="{{ old('abbreviation') ?? $pool->abbreviation }}"
                                                       required placeholder="..." value="{{ old('abbreviation') }}"
                                                       class="form-control @error('abbreviation') is-invalid @enderror">
                                                @error('abbreviation')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'abbréviation déjà existant' }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group input-group col-12 row">
                                            <label class="col-3">Région cotonnière</label>
                                            <div class="col-9">
                                                <select name="regionID" id="regionID" required class="form-control @error('regionID') is-invalid @enderror">
                                                    <option value=""></option>
                                                    @foreach($regions as $region)
                                                        <option value="{{$region->id}}">{{$region->nom}}</option>
                                                    @endforeach
                                                </select>
                                                @error('regionID')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'region invalide' }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                            </div>

                            <button type="submit" id="submitForm" class="btn btn-success mt-2">Enregistrer</button>

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