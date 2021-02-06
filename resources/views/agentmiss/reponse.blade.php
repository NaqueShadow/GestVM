@extends('layouts.agentMiss')

@section('content')

    <script>
        document.getElementById("reponses").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">
        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{route('agentMiss.filtreReponse')}}" id="form">
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
                    <th scope="col">Destination</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @foreach($attributions as $attribution)
                    <tr>
                        <td> {{$attribution->created_at->format('d/m/Y')}} </td>
                        <td> {{strlen($attribution->mission->objet) < 26 ?$attribution->mission->objet:substr($attribution->mission->objet,0,25).'...'}} </td>
                        <td> {{$attribution->mission->villeDesti->nom}} </td>
                        <td> {{$attribution->idVehicule}} </td>
                        <td> {{$attribution->chauffeur->nom}} {{$attribution->chauffeur->prenom}} </td>
                        <td>
                            <a href="{{ route('reponse.show', ['attribution' => $attribution->id]) }}">
                                <button class="btn btn-outline-success" title="ouvrir">
                                    ouvrir
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
