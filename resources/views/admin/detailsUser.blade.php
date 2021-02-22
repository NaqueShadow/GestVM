@extends('layouts.admin')

@section('content')

    <script>
        document.getElementById("users").style.backgroundColor = "white";
    </script>

    <div class="mt-3 ml-3 mr-5 align-content-center text-dark" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px; color: #284563; overflow: auto;" >

        @if( session()->get('info') )
            <div class="alert alert-success text-center text-success">
                {{ session()->get('info') }}
            </div>
        @endif

        <div class="h5 text-info text-center">Compte</div>

        <table class="table-sm text-dark" style="min-width: 75%;">

            <tr>
                <th scope="row" class="">Login</th>
                <td>: {{ $user->login }} </td>
                <th scope="row" class="">Statut du compte</th>
                <td>: {{ $user->statut }} </td>
            </tr>

            <tr>
                <th scope="row" class="">Agent</th>
                <td>: {{ $user->agent->nom }} {{ $user->agent->prenom }}</td>
            </tr>

            <div class="mt-3"></div>

            <tr class="mt-3">
                <th scope="row" class="">Matricule</th>
                <td>: {{ $user->matricule }}</td>
            </tr>
        </table>

        <hr>
        <div>
            <div class="h5 text-info text-center">
                Pools
                <button class="btn btn-outline-success pt-1 pb-1" title="affecter un pool" data-toggle="modal" data-target="#fenetre3">
                    +
                </button>
            </div>
            @foreach($user->pools as $pool)
            <div class="offset-2 col-7 row mt-2 border-bottom">
                <div class="col-10">- {{ $pool->designation }}</div>
                <form class="col-2" method="post" action="{{ route('admin.destroyPool', ['user' => $user->id]) }}" style="display: inline;">
                    @csrf
                    @method ('PATCH')
                    <input type="hidden" name="pool" value="{{ $pool->id }}">
                    <button class="btn btn-link text-danger pt-0 pb-0" title="retirer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>

        <hr>
        <div>
            <div class="h5 text-info text-center">
                Roles
                <button class="btn btn-outline-success pt-1 pb-1" title="Attribuer un role" data-toggle="modal" data-target="#fenetre2">
                    +
                </button>
            </div>

            <div class="offset-2 col-7 border-bottom">- {{ __('Demandeur') }}</div>

            @foreach($user->roles as $role)
            <div class="offset-2 col-7 row mt-2 border-bottom">
                <div class="col-10">- {{ $role->role }}</div>
                <form class="col-2" method="post" action="{{ route('admin.destroyRole', ['user' => $user->id]) }}" style="display: inline;">
                    @csrf
                    @method ('DELETE')
                    <input type="hidden" name="role" value="{{ $role->id }}">
                    <button class="btn btn-link text-danger pt-0 pb-0" title="retirer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach
        <hr>
        <div>
            <div class="mt-3">
                <a href="{{ route('admin.index') }}">
                    <button type="submit" id="submitForm" class="btn btn-outline-dark mt-1" style="">Retour</button>
                </a>

                <button class="btn btn-info " title="éditer" data-toggle="modal" data-target="#fenetre">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                    </svg>
                </button>

                <form method="post" action="{{ route('admin.destroy', ['user' => $user->id]) }}" style="display: inline;">
                    @csrf
                    @method ('DELETE')
                    <button class="btn btn-danger" title="supprimer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div>
        <div class="modal fade" id="fenetre" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edition d'un compte</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form class="mt-5" method="post" action="{{ route('admin.update', ['user' => $user->id]) }}" id="form">
                            @method('PATCH')
                            @csrf
                            @include('admin.include.userForm')
                            <button type="submit" id="submitForm" class="btn btn-success mt-2">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="modal fade" id="fenetre2" tabindex="-1" aria-labelledby="fenetre2" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <form class="mt-5" method="post" action="{{route('admin.storeRole', ['user' => $user->id])}}" id="form">
                            @csrf
                            <div class="align-items-center">
                                <div class="form-row"
                                     style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
                                    <div class="col-12">
                                        <label class="font-weight-bold" for="role">Role :</label>
                                        <select name="role" required id="role" class="selectpicker col-12 form-control @error('role') is-invalid @enderror" @include('include.selectOption')>
                                            <option value=""></option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                            @endforeach
                                        </select>
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

    <div>
        <div class="modal fade" id="fenetre3" tabindex="-1" aria-labelledby="fenetre3" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <form class="mt-5" method="post" action="{{route('admin.storePool', ['user' => $user->id])}}" id="form">
                            @csrf
                            <div class="align-items-center">
                                <div class="form-row"
                                     style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
                                    <div class="col-12">
                                        <label class="font-weight-bold" for="pool">Pool :</label>
                                        <select name="pool" required id="pool" class="selectpicker col-12 form-control @error('pool') is-invalid @enderror" @include('include.selectOption')>
                                            <option value=""></option>
                                            @foreach($pools as $pool)
                                                <option value="{{ $pool->id }}">{{ $pool->designation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" id="submitForm" class="btn btn-success mt-2">Valider</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
