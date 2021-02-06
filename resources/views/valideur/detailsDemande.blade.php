@extends('layouts.valideur')

@section('content')

    <script>
        @if($mission->validation != 'Aucun avis')
            document.getElementById("validations").style.backgroundColor = "white";
        @else
            document.getElementById("demandes").style.backgroundColor = "white";
        @endif
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

        @if( session()->get('info') )
            <div class="alert alert-success text-center text-success">
                {{ session()->get('info') }}
            </div>
            <hr class="mt-3">
        @endif

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Demandeur :</div>
            <div class="col-8 form-control">{{ $mission->dmdeur->agent->nom }} {{ $mission->dmdeur->agent->prenom }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Mission :</div>
            <div class="col-6 form-control">{{ $mission->objet }}</div>
            <div class="col-2 text-primary form-control">[{{ $mission->validation }}]</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Trajet :</div>
            <div class="col-6 form-control">{{ $mission->villeDep->nom }} - {{ $mission->villeDesti->nom }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Depart :</div>
            <div class="col-3 form-control">{{ $mission->dateDepart->format('d/m/Y') }}</div>
            <div class="col-2 text-right font-weight-bold">Retour :</div>
            <div class="col-3 form-control">{{ $mission->dateRetour->format('d/m/Y') }}</div>
        </div>

        @if(!empty($mission->typeV) || !empty($mission->codeV) || !empty($mission->idChauf))
                <div class="row mt-4">
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
                <div class="col">{{ $mission->commentaire }}</div>
            </div>
        @endisset

        <hr class="mt-3">
        <div class="row">
        <div class="col-3">
            @if($mission->validation != 'Validée')
            <form method="post" action="{{ route('valideur.valider', ['mission' => $mission->id]) }}" style="display: inline;">
                @csrf
                <input type="hidden" name="validation" value="valide">
                <button class="btn btn-success" title="valider la demande">
                    Valider
                </button>
            </form>
            @endif

            @if($mission->validation != 'Invalidée' && empty($mission->attributions->first()))
            <form method="post" action="{{ route('valideur.valider', ['mission' => $mission->id]) }}" style="display: inline;">
                @csrf
                <input type="hidden" name="validation" value="invalide">
                <button class="btn btn-warning" title="invalider la demande">
                    Invalider
                </button>
            </form>
            @endif
        </div>
            {{--
            <div class="col"></div>
            <div class="col-2">
                <a href="{{ route('valideur.index') }}">
                    <button type="submit" id="submitForm" class="btn btn-danger mt-1" style="">Terminer</button>
                </a>
            </div>
            --}}
        </div>

    </div>

@endsection

