@extends('layouts.respPool')

@section('content')

    <script>
        document.getElementById("affectations").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">
        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{route('respPool.filtreAttribution')}}" id="form">
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <div class="col"></div>
                        <select name="categorie" required class="text-info custom-select col-2">
                            <option value="enCours" {{ $filtre['categorie'] == 'enCours' ? 'selected' : '' }}>en cours</option>
                            <option value="termine" {{ $filtre['categorie'] == 'termine' ? 'selected' : '' }}>terminées</option>
                        </select>
                        <select name="periode" required class="text-info custom-select col-2">
                            <option value="tous" {{ $filtre['periode'] == 'tous' ? 'selected' : '' }}>tous</option>
                            <option value="avant" {{ $filtre['periode'] == 'avant' ? 'selected' : '' }}>fait avant le</option>
                            <option value="le" {{ $filtre['periode'] == 'le' ? 'selected' : '' }}> fait le</option>
                            <option value="apres" {{ $filtre['periode'] == 'apres' ? 'selected' : '' }}>fait après le</option>
                        </select>
                        <input type="date" name="date" required value="{{ $filtre['date'] ?? today()->format('Y-m-d') }}" class="col-3 form-control">
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
            <table class="table table-striped table-hover">
                <thead>
                <tr class="table-success">
                    <th scope="col">Date</th>
                    <th scope="col">Mission</th>
                    <th scope="col">Période</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($attributions as $attribution)
                    <tr>
                        <td> {{$attribution->updated_at->format('d/m/Y')}} </td>
                        <td> {{strlen($attribution->mission->objet) < 26 ?$attribution->mission->objet:substr($attribution->mission->objet,0,25).'...'}} </td>
                        <td> {{$attribution->mission->dateDepart->format('d/m')}} - {{$attribution->mission->dateRetour->format('d/m/Y')}} </td>
                        <td> {{$attribution->mission->villeDesti->nom}} </td>
                        <td> {{$attribution->idVehicule}} </td>
                        <td> {{$attribution->chauffeur->nom}} {{$attribution->chauffeur->prenom,0,10}} </td>
                        <td>
                            <div class="dropdown">
                                <button title="exporter" class="btn btn-link text-primary pt-0 pb-0 dropdown-toggle" data-toggle="dropdown" >
                                </button>
                                <div class="dropdown-menu dropdown-menu-sm-right">
                                    @if($attribution->statut == 1)
                                        <a href="/attribution/{{ $attribution->id }}/destroy" class="dropdown-item">
                                            <button class="btn btn-link text-danger" title="annuler l'attribution">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                </svg> annuler l'affectation
                                            </button>
                                        </a>

                                        <a href="/attribution/{{ $attribution->id }}/terminer" class="dropdown-item">
                                            <button class="btn btn-link text-info" title="mission terminée">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                                </svg> confirmer le retour
                                            </button>
                                        </a>
                                    @endif
                                    <form class="dropdown-item" method="post" action="{{ route('pdf.attribution', ['attribution' => $attribution->id]) }}">
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
