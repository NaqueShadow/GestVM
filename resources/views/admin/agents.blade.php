@extends('layouts.admin')

@section('content')

    <script>
        document.getElementById("agents").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="height: 500px; color: #284563; margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{route('admin.rechercheAgent')}}" id="form">
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

                <button type="button" class="btn btn-success mt-1 mb-1" data-toggle="modal" data-target="#fenetre2">
                    + depuis un classeur
                </button>

            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">MATRICULE</th>
                    <th scope="col">CHAUFFEUR</th>
                    <th scope="col">POSTE</th>
                    <th scope="col">CONTACT</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach($agents as $ag)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <th>{{ $ag->matricule }}</th>
                        <th>{{ $ag->nom }}</th>
                        <th>{{ $ag->prenom }}</th>
                        <td>{{ $ag->poste }}</td>
                        <td>{{ $ag->telephone }}</td>
                        <td>
                            <a href="{{ route('admin.editAgent', ['agent' => $ag->matricule]) }}">
                                <button class="btn btn-info " title="éditer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                </button>
                            </a>
                            <form method="post" action="{{ route('admin.destroyAgent', ['agent' => $ag->matricule]) }}" style="display: inline;">
                                @csrf
                                @method ('DELETE')
                                <button class="btn btn-danger" title="supprimer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
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
                    <h5 class="modal-title" id="exampleModalLabel">Enregistrement d'un nouvel Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form class="mt-5" method="post" action="{{route('admin.storeAgent')}}" id="form">
                        @csrf
                        @include('admin.include.agentForm')
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
