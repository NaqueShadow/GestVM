@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("pools").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="row">
                <div class=" col text-success h4">Pool / {{$pool->designation}}</div>
                <div class="col-auto btn-group mr-0">
                    <a href="{{ route('pool.show', ['pool' => $pool->id]) }}"><button class="btn btn-light">Véhicules</button></a>
                    <a href="{{ route('pool.showChauf', ['pool' => $pool->id]) }}"><button class="btn btn-light active">Chauffeurs</button></a>
                    <a href="{{ route('pool.showEntite', ['pool' => $pool->id]) }}"><button class="btn btn-light">Entités</button></a>
                </div>
            </div>
        </div>

        <div class="card-body h-100" style="color: #284563; overflow: auto;">
            @if( session()->get('info') )
                <div class="alert alert-success text-center text-success">
                    {{ session()->get('info') }}
                </div>
            @endif

            <table class="table table-striped table-hover">
                <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Matricule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach($pool->chauffeurs as $chauffeur)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <th>{{ $chauffeur->matricule }}</th>
                        <th>{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</th>
                        <td>{{ $chauffeur->telephone }}</td>
                        <td>{{ isset($chauffeur->vehicule->code) ? $chauffeur->vehicule->code : '' }} </td>
                        <td>
                            <a href="{{ route('pool.retraitChauffeur', ['chauffeur' => $chauffeur->matricule]) }}">
                                <button class="btn btn-danger p-1" title="retirer">
                                    retirer
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="modal-content">

                <form class="" method="post" action="{{ route('pool.ajoutChauffeur', ['pool' => $pool->id]) }}" id="form">
                    @csrf
                    <div class="align-items-center">
                        <div  class="form-group row ml-3 mt-2">
                            <select name="chauffeurs[]" id="chauffeurChosen" required class="col-10 custom-select chosen-select" multiple>
                                @foreach($chauffeurs as $chauffeur)
                                    <option value="{{$chauffeur->matricule}}">{{$chauffeur->nom}} {{$chauffeur->prenom}}</option>
                                @endforeach
                            </select>
                            <button type="submit" id="submitForm" class="ml-1 btn btn-success" >Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('chosen')
    <script>
        $("#chauffeurChosen").chosen({
            placeholder_text_multiple: "Ajouter des Chauffeurs",
            no_results_text: "aucun resultat trouvé"
        });
    </script>
@endsection
