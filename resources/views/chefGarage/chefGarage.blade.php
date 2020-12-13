@extends('layouts.chefGarage')

@section('content')

    <div class="col-12" style="">


        <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
            <div class="card-header bg-light text-success h4">
                <h5 class="text-success text-center">Besoins d'intervention</h5>
            </div>

            <div class="card-body row" style="color: #284563;">

                <button type="button" class="btn btn-success mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                    + Nouveau
                </button>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vehicule</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Début</th>
                        <th scope="col">Fin prévisionnelle</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody id="">
                    @foreach($interventions as $intervention)
                    <tr>
                        <th scope="row"></th>
                        <td>{{ $intervention->idVehicule }}</td>
                        <td>{{ $intervention->type }}</td>
                        <td>{{ $intervention->debut }}</td>
                        <td>{{ $intervention->finPrev }}</td>
                        <button class="btn btn-danger p-2" title="supprimer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                        <button class="btn btn-info p-2" title="éditer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                        </button>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

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

                                                @foreach($vehicules as $vehicule)
                                                    <option value="{{ $vehicule->code }}">{{ $vehicule->code }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('idVehicule')
                                        <div class="invalide-feedBack()">
                                            {{ $errors->first('idVehicule') }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-3"></div>

                                    <div  class="form-group input-group col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Début</div>
                                        </div>
                                        <input type="date" name="debut" required id="debut" value="{{ old('debut') }}" class="form-control @error('dateDepart') is-invalid @enderror">
                                        @error('debut')
                                        <div class="invalide-feedBack()">
                                            {{ $errors->first('debut') }}
                                        </div>
                                        @enderror
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
                                                <option value="">Maintenance préventive</option>
                                                <option value="">Maintenance curative</option>
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
