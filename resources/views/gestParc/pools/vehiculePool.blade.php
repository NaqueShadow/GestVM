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
                    <a href="{{ route('pool.show', ['pool' => $pool->id]) }}"><button class="btn btn-light active">Véhicules</button></a>
                    <a href="{{ route('pool.showChauf', ['pool' => $pool->id]) }}"><button class="btn btn-light">Chauffeurs</button></a>
                </div>
            </div>
        </div>

        <div class="card-body h-100" style="color: #284563; overflow: auto;">

            @if( session()->get('info') )
                <div class="alert alert-success text-center text-success">
                    {{ session()->get('info') }}
                </div>
            @endif

            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Acquisition</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach( $pool->vehicules as $vehicul )
                    <tr>
                        <th>{{ ++$i }}</th>
                        <th>{{ $vehicul->code }}</th>
                        <td>{{ $vehicul->modele }}</td>
                        <td>{{ $vehicul->acquisition ? $vehicul->acquisition->format('d/m/Y'):''}}</td>
                        <td>
                            {{ isset($vehicul->chauffeur->nom) ? $vehicul->chauffeur->nom.' '.$vehicul->chauffeur->prenom : '--' }}
                        </td>
                        <td>
                            <a href="{{route('vehicule.fullShow', ['vehicule' => $vehicul->code])}}">
                                <button class="btn btn-info p-1">
                                    ouvrir
                                </button>
                            </a>
                            <a href="{{ route('pool.retraitVehicule', ['vehicule' => $vehicul->code]) }}">
                                <button class="btn btn-danger p-1" title="retirer">
                                    rétirer
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="modal-content">

                <form class="" method="post" action="{{ route('pool.ajoutVehicule', ['pool' => $pool->id]) }}" id="form">
                    @csrf
                    <div class="align-items-center">
                        <div  class="form-group row ml-3 mt-2">
                            <select name="vehicules[]" id="vehiculeChosen" required class="col-10 custom-select chosen-select" multiple>
                                @foreach($vehicules as $vehicule)
                                    <option value="{{$vehicule->code}}">{{$vehicule->code}}</option>
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
        $("#vehiculeChosen").chosen({
            placeholder_text_multiple: "Ajouter des Vehicules",
            no_results_text: "aucun resultat trouvé"
        });
    </script>
@endsection
