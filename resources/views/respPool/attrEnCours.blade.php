@extends('layouts.respPool')

@section('content')

    <script>
        document.getElementById("affectations").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{route('respPool.filtreAttribution')}}" id="form">
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <select name="categorie" required class="text-info custom-select col-3">
                            <option value="enCours" {{ $filtre['categorie'] == 'enCours' ? 'selected' : '' }}>en cours</option>
                            <option value="termine" {{ $filtre['categorie'] == 'termine' ? 'selected' : '' }}>terminées</option>
                        </select>
                        <select name="periode" required class="text-info custom-select col-4">
                            <option value="tous" {{ $filtre['periode'] == 'tous' ? 'selected' : '' }}>tous</option>
                            <option value="avant" {{ $filtre['periode'] == 'avant' ? 'selected' : '' }}>fait avant le</option>
                            <option value="le" {{ $filtre['periode'] == 'le' ? 'selected' : '' }}> fait le</option>
                            <option value="apres" {{ $filtre['periode'] == 'apres' ? 'selected' : '' }}>fait après le</option>
                        </select>
                        <input type="date" name="date" required value="{{ $filtre['date'] ?? today()->format('Y-m-d') }}" class="col-4 form-control">
                        <button type="submit" id="submitForm" class="btn btn-outline-info col-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body row" style="color: #284563;">
            <button type="button" class="btn btn-success mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                + Attribution
            </button>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Mission</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($attributions as $attribution)
                    <tr>
                        <td> {{$attribution->updated_at->format('d/m/Y')}} </td>
                        <td> {{substr($attribution->mission->objet,0,25).'...'}} </td>
                        <td> {{$attribution->mission->dateDepart->format('d/m')}} - {{$attribution->mission->dateRetour->format('d/m/Y')}} </td>
                        <td> {{$attribution->mission->villeDesti->nom}} </td>
                        <td> {{$attribution->idVehicule}} </td>
                        <td> {{$attribution->chauffeur->nom}} {{substr($attribution->chauffeur->prenom,0,10).'...'}} </td>
                        <td>
                            <a href="/attribution/{{ $attribution->id }}/destroy">
                            <button class="btn btn-danger p-2" title="annuler l'attribution">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                            </a>
                            @if($attribution->statut == 1)
                            <a href="/attribution/{{ $attribution->id }}/terminer">
                            <button class="btn btn-info p-2" title="mission terminée">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                </svg>
                            </button>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <div>
        <div class="modal fade" id="fenetre" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enregistrement d'une nouvelle intervention</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="mt-5" method="post" action="{{route('intervention.store')}}" id="form">

                            @csrf
                            <div class="align-items-center">

                                <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                                    <div class="col-3"></div>
                                    <div  class="form-group col-6">

                                        <div class="">
                                            <select name="idVehicule" required id="idVehicule" class="custom-select @error('idVehicule') is-invalid @enderror">

                                                <option value="">selectionner un véhicule</option>



                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-3"></div>

                                    <div  class="form-group input-group col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Début</div>
                                        </div>
                                        <input type="date" name="debut" required id="debut" value="{{ old('debut') }}" class="form-control @error('dateDepart') is-invalid @enderror">

                                    </div>

                                    <div  class="form-group input-group col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Fin</div>
                                        </div>
                                        <input type="date" name="finPrev" required id="finPrev" value="{{ old('finPrev') }}" class="form-control @error('dateRetour') is-invalid @enderror">
                                        @error('finPrev')
                                        <div class="invalide-feedBack()">
                                            {{ $errors->first('finPrev') }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-3"></div>
                                    <div  class="form-group col-6">

                                        <div class="">
                                            <select name="type" required id="type" class="custom-select @error('type') is-invalid @enderror">
                                                <option value="">selectionner le motif</option>
                                                <option value="preventive">Maintenance préventive</option>
                                                <option value="curative">Maintenance curative</option>
                                            </select>
                                        </div>
                                        @error('type')
                                        <div class="invalide-feedBack()">
                                            {{ $errors->first('type') }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-3"></div>

                                </div>

                            </div>

                            <button type="submit" id="submitForm" class="btn btn-success mt-2" >Enregistrer</button>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <small>Demande d'intervention</small>
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
