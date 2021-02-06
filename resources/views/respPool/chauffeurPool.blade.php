@extends('layouts.respPool')

@section('content')

    <script>
        document.getElementById("chauffeurs").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="row w-100">
                <div  class="col-5 ml-0">
                    <div class="btn-group col">
                        <a href="{{ route('respPool.chauffeurs') }}"><button class="btn btn-light active">Liste</button></a>
                        <a href="{{ route('respPool.absences') }}"><button class="btn btn-light">Absence</button></a>
                    </div>
                </div>
                <form class="col" method="post" action="{{route('respPool.rechercheChauffeur')}}" id="form">
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
                    <th scope="col">Matricule</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Véhicule</th>
                    <th scope="col">Nbre. mission</th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach($chauffeurs as $chauffeur)
                    <tr>
                        <th>{{ ++$i }}</th>
                        <td>{{ $chauffeur->matricule }}</td>
                        <th>{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</th>
                        <td>{{ $chauffeur->telephone }}</td>
                        <td>{{ isset($chauffeur->vehicule->code) ? $chauffeur->vehicule->code : '' }} </td>
                        <td>{{ $chauffeur->attributions_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>

    </div>
@endsection
