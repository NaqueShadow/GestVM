@extends('layouts.agentMiss')

@section('content')

    <script>
        document.getElementById("demandes").style.backgroundColor = "white";
    </script>

    <div class="mt-3 ml-5 mr-5 row align-content-center">
        <div class="col"></div>
        <div class="col-auto">
            <form method="post" action="{{ route('pdf.demande', ['mission' => $mission->id]) }}">
                @csrf
                <button type="submit" class="btn btn-link col-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-chat-text" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg> Pdf
                </button>
            </form>
        </div>
    </div>
    <div class="mt-2 ml-5 mr-5 align-content-center text-dark" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px; color: #284563;" >

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Mission :</div>
            <div class="col-8 form-control">{{ $mission->objet }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Trajet :</div>
            <div class="col-8 form-control">{{ $mission->villeDep->nom }} - {{ $mission->villeDesti->nom }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Depart :</div>
            <div class="col-2 form-control">{{ $mission->dateDepart->format('d/m/Y') }}</div>
            <div class="col-2 text-right font-weight-bold">Retour :</div>
            <div class="col-4 form-control">{{ $mission->dateRetour->format('d/m/Y') }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Valideur :</div>
            <div class="col-3 form-control">{{ $mission->valideur->agent->nom }} {{ $mission->valideur->agent->prenom }}</div>
            <div class="col-2 text-right font-weight-bold">Avis :</div>
            <div class="col-3 form-control text-primary">[ {{ $mission->validation }} ]</div>
        </div>

        @if(!empty($mission->typeV) || !empty($mission->codeV) || !empty($mission->idChauf))
            <div class="row mt-3">
                <div class="col-3 text-right font-weight-bold">Préférence :</div>
                <div class="col-3 form-control">Véhicule de {{ $mission->typeV }}</div>
                <div class="col-2 text-right font-weight-bold">Code :</div>
                <div class="col-3 form-control">{{ $mission->codeV }}</div>
            </div>
            <div class="row mt-3">
                <div class="col-6"></div>
                <div class="col-2 text-right font-weight-bold">Chauffeur :</div>
                <div class="col-3 form-control">
                    @if($mission->idChauf)
                    {{ $mission->chauffeur->nom }} {{ $mission->chauffeur->prenom }} ({{ $mission->chauffeur->matricule }})
                    @endif
                </div>
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-3 text-right font-weight-bold">Participant(s) :</div>
            <div class="col-9 text-right"></div>
            @foreach($mission->agents as $agent)
                <div class="col-3 text-right"></div>
                <div class="col-3">- {{ $agent->nom }} {{ $agent->prenom }}</div>
                <div class="col-6">{{ $agent->poste }}</div>
            @endforeach
        </div>

        @isset($mission->commentaire)
            <div class="row mt-4">
                <div class="col-3 text-right font-weight-bold">Commentaire :</div>
                <div class="col-8 form-control">{{ $mission->commentaire }}</div>
            </div>
        @endisset

        <div class="mt-5">
            <a href="{{ route('agentMiss.index') }}">
                <button type="submit" id="submitForm" class="btn btn-outline-dark mt-1" style="">Retour</button>
            </a>
            @if(!empty($mission->attributions->first()) || $mission->validation != 'Aucun avis')
                <span class="col text-right text-primary h6">(Traitement enclenché)</span>
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

    </div>

@endsection
