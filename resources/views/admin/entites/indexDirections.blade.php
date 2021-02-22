@extends('layouts.admin')

@section('content')

    <script>
        document.getElementById("entites").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link text-info h5" href="{{ route('activite.index') }}">Activités</a>
                </li>
                <li class="nav-item bg-white">
                    <a class="nav-link text-success h5 active" href="{{ route('direction.index') }}">Directions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info h5" href="{{ route('entite.index') }}">Entités (services)</a>
                </li>
            </ul>
        </div>

        <div class="card-body h-100" style="color: #284563; overflow: auto;">

            <div class="">
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

                <button type="button" class="btn btn-success pb-1 mb-1" data-toggle="modal" data-target="#fenetre">
                    + Nouveau
                </button>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">DIRECTION</th>
                        <th scope="col">ABBREVIATION</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="">
                    @php
                        $i = 0;
                    @endphp
                    @foreach($directions as $direction)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <th>{{ $direction->designation }}</th>
                            <td>{{ $direction->abbreviation }}</td>
                            <td>
                                <div class="dropdown">
                                    <button title="exporter" class="btn btn-link text-primary pt-0 pb-0 dropdown-toggle" data-toggle="dropdown" >
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-sm-right">
                                        <a href="{{ route('direction.edit', ['direction' => $direction->id]) }}" class="dropdown-item">
                                            <button class="btn btn-link text-info " title="éditer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                </svg> éditer
                                            </button>
                                        </a>
                                        <form method="post" class="dropdown-item" action="{{ route('direction.destroy', ['direction' => $direction->id]) }}" style="display: inline;">
                                            @csrf
                                            @method ('DELETE')
                                            <button class="btn btn-link text-danger" title="supprimer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg> supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div>
        <div class="modal fade" id="fenetre" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enregistrement d'une direction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form class="mt-5" method="post" action="{{route('direction.store')}}" id="form">
                            @csrf
                            <div class="form-group input-group col-12 row">
                                <label class="col-3">Libellé</label>
                                <div class="col-9">
                                    <input type="text" name="designation" id="designation"
                                           value="{{ old('designation') }}" required
                                           placeholder="..." value="{{ old('designation') }}"
                                           class="form-control @error('designation') is-invalid @enderror">
                                    @error('designation')
                                    <div class="invalide-feedBack() text-danger">
                                        {{ 'libellé invalide' }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group input-group col-12 row">
                                <label class="col-3">Abbréviation</label>
                                <div class="col-9">
                                    <input type="text" name="abbreviation" id="abbreviation"
                                           value="{{ old('abbreviation') }}" required
                                           placeholder="..." value="{{ old('abbreviation') }}"
                                           class="form-control @error('abbreviation') is-invalid @enderror">
                                    @error('abbreviation')
                                    <div class="invalide-feedBack() text-danger">
                                        {{ 'abbréviation invalide' }}
                                    </div>
                                    @enderror
                                </div>
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

