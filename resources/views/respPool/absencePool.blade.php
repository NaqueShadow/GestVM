@extends('layouts.respPool')

@section('content')

    <script>
        document.getElementById("chauffeurs").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="height: 500px; color: #284563; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="row w-100">
                <div  class="col-5 ml-0">
                    <div class="btn-group col">
                        <a href="{{ route('respPool.chauffeurs') }}"><button class="btn btn-light">Liste</button></a>
                        <a href="{{ route('respPool.absences') }}"><button class="btn btn-light active">Absence</button></a>
                    </div>
                </div>
                <form class="col" method="post" action="{{route('respPool.filtreAbsence')}}" id="form">
                    @method('PATCH')
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <div class="col"></div>
                        <select name="statut" required class="text-info custom-select col-4">
                            <option value="enCours" {{ $statut == 'enCours' ? 'selected' : '' }}>En cours</option>
                            <option value="termine" {{ $statut == 'termine' ? 'selected' : '' }}>Terminées</option>
                        </select>
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

            <button type="button" class="btn btn-success mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                + Nouveau
            </button>

            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">Matr</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Début</th>
                    <th scope="col">Fin</th>
                    <th scope="col">Motif</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($absences as $absence)
                    <tr>
                        <td>{{ $absence->chauffeur->matricule }}</td>
                        <th>{{ $absence->chauffeur->nom }} {{ $absence->chauffeur->prenom }}</th>
                        <td>{{ $absence->debutAbs->format('d/m/Y') }}</td>
                        <td>{{ $absence->finAbs->format('d/m/Y') }} </td>
                        <td>{{ $absence->motif }}</td>
                        @if($absence->finAbs > today())
                        <td>
                            <form method="post" action="{{ route('respPool.destroyAbsence') }}" style="display: inline;">
                                @csrf
                                @method ('DELETE')
                                <input type="hidden" name="idAbs" value="{{ $absence->id }}">
                                <button type="submit" class="btn btn-danger pl-1 pr-1" title="supprimer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                        @endif
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
                        <h5 class="modal-title" id="exampleModalLabel">Enregistrement d'une autorisation d'absence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="mt-5" method="post" action="{{route('respPool.storeAbsence')}}" id="form">

                            @csrf
                            <div class="align-items-center">

                                <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                                    <div class="col-3"></div>
                                    <div  class="form-group col-6">

                                        <div class="">
                                            <select name="idChauf" required id="idChauf" class="selectpicker @error('idChauf') is-invalid @enderror" @include('include.selectOption')>
                                                <option value=""></option>
                                                @foreach($chauffeurs as $chauffeur)
                                                    <option value="{{ $chauffeur->matricule }}" {{$chauffeur->matricule == old('idChauf') ? 'selected':''}}>
                                                        {{ $chauffeur->nom }} {{ $chauffeur->prenom }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @error('idChauf')
                                        <div class="invalide-feedBack()">
                                            {{ $errors->first('idChauf') }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-3"></div>

                                    <div  class="form-group col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Début</div>
                                            </div>
                                            <input type="date" name="debutAbs" required id="debutAbs" value="{{ old('debutAbs') }}" class="form-control @error('debutAbs') is-invalid @enderror">
                                        </div>
                                        @error('debutAbs')
                                        <div class="invalide-feedBack() text-danger">
                                            date invalide
                                        </div>
                                        @enderror
                                    </div>

                                    <div  class="form-group col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Fin</div>
                                            </div>
                                            <input type="date" name="finAbs" required id="finAbs" value="{{ old('finAbs') }}" class="form-control @error('finAbs') is-invalid @enderror">
                                        </div>
                                        @error('finAbs')
                                        <div class="invalide-feedBack() text-danger">
                                            date invalide
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-3"></div>
                                    <div  class="form-group col-6">

                                        <div class="">
                                            <input type="text" name="motif" placeholder="motif..." required id="motif" value="{{ old('motif') }}" class="form-control @error('motif') is-invalid @enderror">
                                        </div>
                                        @error('motif')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ $errors->first('motif') }}
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
