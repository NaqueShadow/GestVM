@extends('layouts.agentMiss')

@section('content')

    <script>
        document.getElementById("demandes").style.backgroundColor = "white";
    </script>

    <div class="mt-5 ml-5 mr-5 align-content-center text-dark" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px; color: #284563;" >

        <table class="table-sm text-info" style="min-width: 75%;">

            <tr>
                <th scope="row" class="text-black-50">Demandeur</th>
                <td>: {{ $mission->dmdeur->agent->nom }} {{ $mission->dmdeur->agent->prenom }} </td>
                <th scope="row"></th>
                <td> </td>
            </tr>

            <tr>
                <th scope="row" class="text-black-50">Mission</th>
                <td>: {{ $mission->objet }}</td>
                <th scope="row"></th>
                <td> </td>
            </tr>

            <div class="mt-3"></div>
            <tr>
                <th scope="row" class="text-black-50">Trajet</th>
                <td>: {{ $mission->villeDep->nom }}</td>
                <td >{{ $mission->villeDesti->nom }}</td>
                <td></td>
            </tr>
            <div class="mt-3"></div>
            <tr>
                <th scope="row" class="text-black-50">Depart</th>
                <td>: {{ $mission->dateDepart->format('d-m-Y') }}</td>
                <th scope="row" class="text-center text-black-50">Retour</th>
                <td>: {{ $mission->dateRetour->format('d-m-Y') }}</td>
            </tr>

            <tr class="mt-3"></tr>
            <tr class="pt-3">
                <th scope="row"></th>
                <th scope="row" class="text-black-50">Participant (s) : {{ $mission->nbr }}</th>
                <td></td>
                <td></td>
            </tr>
            @foreach($mission->agents as $agent)
            <div class="mt-3"></div>
            <tr>
                <th scope="row"></th>
                <td> </td>
                <td scope="row">{{ $agent->nom }} {{ $agent->prenom }}</td>
                <td class="text-black-50">{{ $agent->poste }}</td>
            </tr>
            @endforeach
        </table>

        @isset($mission->commentaire)
            <tr class="mt-2">
                <th scope="row" class="text-black-50">Commentaire</th>
                <td>: {{ $mission->commentaire }}</td>
            </tr>
        @endisset

        @if( session()->get('info') )
            <div class="alert alert-success text-center text-success">
                {{ session()->get('info') }}
            </div>
        @endif


        <a href="{{ route('agentMiss.index') }}">
        <button type="submit" id="submitForm" class="btn btn-outline-dark mt-1" style="">Retour</button>
        </a>
        @if(!empty($mission->attributions->first->get()))
            <span class="col text-right text-primary h6">(répondu)</span>
        @else
            <a href="/mission/{{ $mission->id }}/destroy">
                <button class="btn btn-danger pl-2 pr-2 mr-1" title="supprimer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                </button>
            </a>
            <a href="mission/{{ $mission->id }}/edit">
                <button class="btn btn-info pl-2 pr-2" title="éditer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                    </svg>
                </button>
            </a>
        @endif

    </div>

@endsection
