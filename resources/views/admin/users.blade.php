@extends('layouts.admin')

@section('content')

    <script>
        document.getElementById("users").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{ route('admin.rechercheUser' ) }}" id="form">
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

            <button type="button" class="btn btn-success mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                + Nouveau
            </button>

            <table class="table table-striped table-hover">
                <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">LOGIN</th>
                    <th scope="col">AGENT</th>
                    <th scope="col">ENTITE</th>
                    <th scope="col">STATUT</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <th>{{ $user->login }}</th> @isset($user->agent->nom)
                        <td>{{ $user->agent->nom }} {{ $user->agent->prenom }}</td>@endisset
                        <td>{{ $user->agent->idEntite? $user->agent->entite->abbreviation:'' }}</td>
                        <td class="text-primary">{{ $user->statut }}</td>
                        <td>
                            <div class="dropdown">
                                <button title="exporter" class="btn btn-link text-primary pt-0 pb-0 dropdown-toggle" data-toggle="dropdown" >
                                </button>
                                <div class="dropdown-menu dropdown-menu-sm-right">
                                    <a href="{{ route('admin.show', ['user' => $user->id]) }}" class="dropdown-item">
                                        <button class="btn btn-link text-info p-1" title="voir les détails">
                                            détails
                                        </button>
                                    </a>
                                    @if($user->statut == 'actif')
                                        <form class="dropdown-item" method="post" action="{{ route('admin.desactiver', ['user' => $user->id]) }}" style="display: inline;">
                                            @csrf
                                            @method ('PATCH')
                                            <button class="btn btn-link text-danger p-1" title="desactiver le compte">
                                                désactiver
                                            </button>
                                        </form>
                                    @else
                                        <form class="dropdown-item" method="post" action="{{ route('admin.activer', ['user' => $user->id]) }}" style="display: inline;">
                                            @csrf
                                            <button class="btn btn-link text-warning p-1" title="desactiver le compte">
                                                activer
                                            </button>
                                        </form>
                                    @endif
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
                        <h5 class="modal-title" id="exampleModalLabel">Nouveau compte</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form class="mt-5" method="post" action="{{route('admin.store')}}" id="form">
                            @csrf
                            <div class="align-items-center">
                                 <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
                                    <div class="form-group input-group col-12 row">
                                        <label class="col-3">Agent</label>
                                        <div class="col-9">
                                            <select name="matricule" id="matricule" class="selectpicker form-control @error('matricule') is-invalid @enderror" @include('include.selectOption') required>
                                                <option value=""></option>
                                                @foreach($agents as $agent)
                                                    <option value="{{ $agent->matricule }}" {{ $agent->matricule == old('matricule') ? 'selected':'' }}>{{ $agent->matricule }}  {{ $agent->nom }} {{ $agent->prenom }}</option>
                                                @endforeach
                                            </select>
                                            @error('matricule')
                                            <div class="invalide-feedBack() text-danger">
                                                {{ 'Cet agent possède déjà un compte' }}
                                            </div>
                                            @enderror
                                        </div>
                                     </div>

                                     <div class="form-group input-group col-12 row">
                                         <label class="col-3">Login</label>
                                         <div class="col-9">
                                             <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}"
                                                    required autocomplete="login">
                                             @error('login')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                             @enderror
                                         </div>
                                     </div>

                                     <div class="form-group input-group col-12 row">
                                         <label class="col-3">Statut</label>
                                         <div class="col-9">
                                             <select name="statut" id="statut" class="form-control" required placeholder="...">
                                                 <option value=""></option>
                                                 <option value="1" {{ '1' == old('statut') ? 'selected':'' }}>Actif</option>
                                                 <option value="0" {{ '0' == old('statut') ? 'selected':'' }}>Bloquer</option>
                                             </select>
                                             @error('statut')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                             @enderror
                                         </div>
                                     </div>

                                        <div class="form-group input-group col-12 row">
                                            <label class="col-3">Mot de passe</label>
                                            <div class="col-9">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                                       name="password" value="{{ old('password') }}" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group input-group col-12 row">
                                            <label class="col-3">Confirmation</label>
                                            <div class="col-9">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                                       required autocomplete="new-password">
                                            </div>
                                        </div>

                                 </div>
                            </div>
                            <button type="submit" id="submitForm" class="btn btn-success mt-2">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
