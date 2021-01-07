@extends('layouts.agentMiss')

@section('content')

    <script>
        document.getElementById("demandes").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{ route('agentMiss.filtreDemande') }}" id="form">
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <select name="categorie" required class="text-info custom-select col-3">
                            <option value="enAttente" {{ $filtre['categorie'] == 'enAttente' ? 'selected' : '' }}>en attente</option>
                            <option value="traite" {{ $filtre['categorie'] == 'traite' ? 'selected' : '' }}>traitées</option>
                            <option value="nonTraite" {{ $filtre['categorie'] == 'nonTraite' ? 'selected' : '' }}>non traitées</option>
                        </select>
                        <select name="periode" required class="text-info custom-select col-4">
                            <option value="tous" {{ $filtre['periode'] == 'tous' ? 'selected' : '' }}>tous</option>
                            <option value="avant" {{ $filtre['periode'] == 'avant' ? 'selected' : '' }}>fait avant le</option>
                            <option value="le" {{ $filtre['periode'] == 'le' ? 'selected' : '' }}> fait le</option>
                            <option value="apres" {{ $filtre['periode'] == 'apres' ? 'selected' : '' }}>fait après le</option>
                        </select>
                        <input type="date" name="date" required value="{{ $filtre['date'] ?? today()->format('Y-m-d') }}" class="col-4 form-control">
                        <button type="submit" id="submitForm" class="btn btn-outline-info col-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body row" style="color: #284563;">

            <a href="{{ route('mission.create') }}">
                <button type="button" class="btn btn-success mt-1 mb-1" >+ Nouvelle requête</button>
            </a>

            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Mission</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Depart</th>
                    <th scope="col">Retour</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($missions as $mission)
                    <tr>
                        <td> {{$mission->created_at->format('d/m/Y')}} </td>
                        <td> {{substr($mission->objet,0,30).' ...'}} </td>
                        <td> {{$mission->villeDesti->nom}} </td>
                        <td> {{$mission->dateDepart->format('d/m/Y')}} </td>
                        <td> {{$mission->dateRetour->format('d/m/Y')}} </td>
                        <td>
                            <a href="{{ route('mission.show', ['mission' => $mission->id]) }}">
                                <button class="btn btn-success" title="ouvrir">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                    </svg>
                                </button>
                            </a>
                            @if(!empty($mission->attributions->first->get()))
                                <span class="col text-right text-primary h6">(répondu)</span>
                            @else
                                <a href="mission/{{ $mission->id }}/edit">
                                    <button class="btn btn-info pl-2 pr-2" title="éditer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </button>
                                </a>
                                <a href="/mission/{{ $mission->id }}/destroy">
                                    <button class="btn btn-danger pl-2 pr-2" title="supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

    </div>


@endsection
