@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("documents").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{route('gestParc.filtreDoc')}}" id="form">
                    @method('PATCH')
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <div class="col">
                            <button type="button" class="btn btn-success pb-1" data-toggle="modal" data-target="#fenetre">
                                + Nouveau
                            </button>
                        </div>
                        <input type="text" name="code" placeholder="tous les véhicule.." value="{{ $filtre['code'] }}" class="col-2 form-control">
                        <select name="type" required class="text-info custom-select col-3">
                            <option value="1" {{ $filtre['type'] == '1' ? 'selected' : '' }}>Assurance</option>
                            <option value="2" {{ $filtre['type'] == '2' ? 'selected' : '' }}>Visite technique</option>
                            <option value="3" {{ $filtre['type'] == '3' ? 'selected' : '' }}>Carte grise</option>
                        </select>
                        <button type="submit" id="submitForm" class="btn btn-outline-info col-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body h-100" style="color: #284563; overflow: auto;">

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

            <table class="table table-striped table-hover">
                <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Numéro</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Document</th>
                    <th scope="col">Etablissement</th>
                    <th scope="col">Expiration</th>
                    <th scope="col">Lieu</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach( $docs as $doc )
                    <tr>
                        <th>{{ ++$i }}</th>
                        <th>{{ $doc->numero }}</th>
                        <td>{{ $doc->vehicule->code ? $doc->vehicule->code:'' }}</td>
                        <td>{{ $doc->type }}</td>
                        <td>
                            {{ $doc->etabl->format('d/m/Y') }}
                        </td>
                        <td>{{ $doc->exp->format('d/m/Y') }}</td>
                        <td>{{ $doc->lieu }}</td>
                        <td>
                            <div class="dropdown">
                                <button title="exporter" class="btn btn-link text-primary pt-0 pb-0 dropdown-toggle" data-toggle="dropdown" >
                                </button>
                                <div class="dropdown-menu dropdown-menu-sm-right">
                                    <a href="{{route('gestParc.editDoc', ['doc' => $doc->numero])}}" class="dropdown-item">
                                        <button class="btn btn-link text-info" title="éditer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                            </svg> éditer
                                        </button>
                                    </a>
                                    <form class="dropdown-item" method="post" action="{{ route('gestParc.destroyDoc') }}" style="display: inline;">
                                        @csrf
                                        @method ('DELETE')
                                        <input type="hidden" name="numero" value="{{ $doc->numero }}">
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

    <div>
        <div class="modal fade" id="fenetre" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enregistrement d'un document de bord</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form class="mt-5" method="post" action="{{route('gestParc.storeDoc')}}" id="form">

                            @csrf
                            <div class="align-items-center">

                                <fieldset>
                                    <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Code véhicule</label>
                                            <div class="col-9">
                                            <input type="text" name="idVehicule" id="idVehicule" value="{{ old('idVehicule') }}" required placeholder="..." value="{{ old('idVehicule') }}" class="form-control @error('code') is-invalid @enderror">
                                            @error('idVehicule')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'code non reconnu' }}
                                                </div>
                                            @enderror
                                            </div>
                                        </div>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Document</label>
                                            <div class="col-9">
                                                <select name="type" required id="type" class="custom-select @error('type') is-invalid @enderror">
                                                    <option value="">...</option>
                                                    <option value="1" {{'1' == old('type') ? 'selected':''}}>Assurance</option>
                                                    <option value="2" {{'2' == old('type') ? 'selected':''}}>Visite technique</option>
                                                    <option value="3" {{'3' == old('type') ? 'selected':''}}>Carte grise</option>
                                                </select>
                                                @error('type')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ ' ' }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Numéro</label>
                                            <div class="col-9">
                                                <input type="text" name="numero" id="numero" value="{{ old('numero') ?? $docB->numero }}" required placeholder="..." value="{{ old('immatriculation') }}" class="form-control @error('immatriculation') is-invalid @enderror">
                                                @error('numero')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'information invalide' }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Date d'établissement</label>
                                            <div class="col-9">
                                                <input type="date" name="etabl" required id="etabl" value="{{ old('etabl') }}" class="form-control @error('etabl') is-invalid @enderror">
                                                @error('etabl')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'information invalide' }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Date d'expiration</label>
                                            <div class="col-9">
                                                <input type="date" name="exp" required id="exp" value="{{ old('exp') }}" class="form-control @error('exp') is-invalid @enderror">
                                                @error('exp')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'information invalide' }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div  class="form-group input-group col-12 row">
                                            <label class="col-3">Lieu d'établissement</label>
                                            <div class="col-9">
                                                <input type="text" name="lieu" id="lieu" value="{{ old('lieu') ?? $docB->lieu }}" required placeholder="..." value="{{ old('lieu') }}" class="form-control @error('lieu') is-invalid @enderror">
                                                @error('lieu')
                                                <div class="invalide-feedBack() text-danger">
                                                    {{ 'information invalide' }}
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
