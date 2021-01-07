@extends('layouts.respPool')

@section('content')

    <script>
        document.getElementById("demandes").style.backgroundColor = "white";
    </script>

    <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%; height: auto">
        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{ route('respPool.filtreDemande') }}" id="form">
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

            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Demandeur</th>
                    <th scope="col">Mission</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Depart</th>
                    <th scope="col">Retour</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($missions as $mission)
                    <tr>
                        <td> {{$mission->updated_at->format('d-m-Y')}} </td>
                        <td> {{$mission->dmdeur->agent->nom}} {{substr($mission->dmdeur->agent->prenom,0,15).'...'}} </td>
                        <td> {{substr($mission->objet,0,15).'...'}} </td>
                        <td> {{$mission->villeDesti->nom}} </td>
                        <td> {{$mission->dateDepart->format('d-m-Y')}} </td>
                        <td> {{$mission->dateRetour->format('d-m-Y')}} </td>
                        <td>
                            <a href="/attribution/{{ $mission->id }}">
                            <button class="btn btn-info" title="traiter la requête">
                                Ouvrir
                            </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>







@endsection
