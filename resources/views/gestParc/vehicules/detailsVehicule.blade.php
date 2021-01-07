@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("vehicules").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center" style="box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; height: auto">

        <div class="card-body row" style="color: #284563;">
            <div class="col-6 pl-5">
                <table class="table table-responsive">
                    <tr>
                        <td>code véhicule</td> <td class="text-info h5">     {{$vehicule->code}}</td>
                    </tr>
                    <tr>
                        <td>Modele</td> <td class="text-info h5">     {{$vehicule->modele}}</td>
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
                            <td>Chauffeur</td>
                            <td class="text-info h5">:   {{$vehicule->chauffeur->nom}} {{$vehicule->chauffeur->prenom}}</td>
                            <td class="">
                                <button type="button" class="btn btn-outline-warning mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                                    Editer
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Matricule</td> <td class="text-info h5">:   {{$vehicule->idChauf}}</td>
                        </tr>
                        <tr>
                            <td>Contact</td> <td class="text-info h5">:   {{$vehicule->chauffeur->telephone}}</td>
                        </tr>
                    </table>
                @else
                    <div class="text-dark mt-5">Véhicule sans chauffeur affecté</div>
                    <button type="button" class="btn btn-success mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                        + Chauffeur
                    </button>
                @endif
            </div>

            <div class="col-12 " style="">
                <table class="table ">
                    <tr>
                        <td></td> <td class="">code</td> <td class="">établit le</td> <td class="">expire le</td>
                    </tr>
                    <tr>
                        <th class="t">Visite technique</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                    <tr>
                        <th>Assurance</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                    <tr>
                        <th>Carte grise</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                </table>
            </div>

        </div>

        <div>
        <a href="{{ route('gestParc.index') }}">
            <button type="submit" id="submitForm" class="btn btn-outline-dark m-2" style="">Retour</button>
        </a>
        <a href="{{ route('vehicule.edit', ['vehicule' => $vehicule->code]) }}">
            <button class="btn btn-info " title="éditer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                </svg>
            </button>
        </a>
        <a href="{{ route('vehicule.destroy', ['vehicule' => $vehicule->code]) }}">
            <button class="btn btn-danger" title="supprimer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
            </button>
        </a>
        </div>

    </div>

    <div>
        <div class="modal fade" id="fenetre" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <form class="mt-5" method="post" action="{{route('vehicule.updateChauffeur', ['vehicule' => $vehicule->code])}}" id="form">
                            @csrf
                            <div class="align-items-center">
                                <div class="form-row"
                                     style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
                                    <div class="col-12">
                                        <select name="idChauf" id="idChauf" required class="col-12 form-control @error('idChauf') is-invalid @enderror">
                                            <option value=""></option>
                                            <option value="null">laisser sans chauffeur</option>
                                            @foreach($chauffeurs as $chauffeur)
                                                <option value="{{ $chauffeur->matricule }}">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</option>
                                            @endforeach
                                        </select>
                                        @error('idChauf')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'chauffeur invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="submitForm" class="btn btn-success mt-2">Valider</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
