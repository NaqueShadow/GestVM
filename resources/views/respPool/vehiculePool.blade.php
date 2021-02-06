@extends('layouts.respPool')

@section('content')

    <script>
        document.getElementById("vehicules").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="">
                <form class="" method="post" action="{{route('respPool.rechercheVehicule')}}" id="form">
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <div class="col"></div>
                        <input type="text" name="text" required {{ isset($text) ? 'value='.$text : '' }} placeholder="recherche" class="col-4 form-control">
                        <button type="submit" id="submitForm" class="btn btn-outline-info col-1" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
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
                    <th>#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Dernier retour</th>
                    <th scope="col">Mission du mois</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach( $vehicules as $vehicule )
                    <tr>
                        <th>{{ ++$i }}</th>
                        <th>{{ $vehicule->code }}</th>
                        <td>{{ $vehicule->modele }}</td>
                        <td>{{ $vehicule->idCateg }}</td>
                        <td>
                            @isset($vehicule->chauffeur->nom)
                                {{ $vehicule->chauffeur->nom }} {{ $vehicule->chauffeur->prenom }}
                            @endisset</td>
                        <td>{{ isset($vehicule->dernierRetour) ? $vehicule->dernierRetour->format('d/m/Y'):'' }}</td>
                        <td>{{ $vehicule->attributions_count }}</td>
                        <td>
                            <a href="{{route('vehicule.show', ['vehicule' => $vehicule->code])}}">
                                <button class="btn btn-info p-1">
                                    detail
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
