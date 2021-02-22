@extends('layouts.chargeImp')

@section('content')

    <script>
        document.getElementById("consommation").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <div class="row mb-0">

                <div class="col">
                    <form class="p-0" method="post" action="{{route('chargeImp.filtreMois')}}" id="form">
                        @csrf
                        <div  class="form-group form-row mb-0">
                            <div class="col"></div>
                            <select name="mois" id="mois" required class="col-2 form-control">
                                @for($i=1; $i<=12; $i++)
                                    <option value="{{$i}}" {{$i == $mois ? 'selected':''}}>{{Date::create(2021, $i)->format('F')}}</option>
                                @endfor
                            </select>
                            <input type="text" name="annee" required {{ isset($annee) ? 'value='.$annee : '' }} placeholder="annee" class="col-1 form-control">
                            <button type="submit" id="submitForm" class="btn btn-outline-info col-1" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body h-100" style="color: #284563; overflow: auto;">
            <div class="row col-12">
                <div class="col h3 text-success">Utilisation du mois de {{Jenssegers\Date\Date::createFromDate(2021, $mois, 1)->format('F')}}</div>
                <div class="p-0 dropdown">
                    <button type="submit" title="exporter" class="btn btn-outline-primary  mt-1 mb-1  dropdown-toggle" data-toggle="dropdown" >
                        Exporter
                    </button>
                    <div class="dropdown-menu">
                        <form class="dropdown-item" method="post" action="{{ route('chargeImp.rapport') }}" id="form">
                            @csrf
                            <div  class="form-group form-row mb-0">
                                <input type="hidden" name="type" required value="xlsx">
                                <input type="hidden" name="mois" required {{ isset($mois) ? 'value='.$mois : '' }}>
                                <button type="submit" title="format xslx" class="btn btn-link text-danger" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg> Xslx
                                </button>
                            </div>
                        </form>
                        <form class="dropdown-item" method="post" action="{{ route('chargeImp.rapport') }}" id="form">
                            @csrf
                            <div  class="form-group form-row mb-0">
                                <input type="hidden" name="type" required value="csv">
                                <input type="hidden" name="mois" required {{ isset($mois) ? 'value='.$mois : '' }}>
                                <button type="submit" title="format csv" class="btn btn-link text-danger" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg> Csv
                                </button>
                            </div>
                        </form>
                        <form class="dropdown-item" method="post" action="{{ route('chargeImp.rapport') }}" id="form">
                            @csrf
                            <div  class="form-group form-row mb-0">
                                <input type="hidden" name="type" required value="pdf">
                                <input type="hidden" name="mois" required {{ isset($mois) ? 'value='.$mois : '' }}>
                                <button type="submit" title="format pdf" class="btn text-danger btn-link  " >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg> Pdf
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-hover table-striped">
                <thead>
                <tr class="table-success">
                    <th>#</th>
                    <th scope="col">SORTIE</th>
                    <th scope="col">UTILISATEUR</th>
                    <th scope="col">VEHICULE</th>
                    <th scope="col">CHAUFFEUR</th>
                    <th scope="col">CARBURANT</th>
                    <th scope="col">DISTANCE</th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach( $attributions as $attribution )
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $attribution->mission->dateDepart->format('d/m/Y') }}</td>
                        <th>{{ $attribution->mission->idEntite ? $attribution->mission->entite->designation:'' }}</th>
                        <td>{{ $attribution->idVehicule }}</td>
                        <td>{{ $attribution->chauffeur->nom }} {{ $attribution->chauffeur->prenom }}</td>
                        @if(isset($attribution->ressource->id))
                            <td title="volume de carburant">{{ $attribution->ressource->carburant }} L</td>
                            <td title="compteur au depart">{{ $attribution->ressource->comptRetour - $attribution->ressource->comptDepart }} Km</td>
                        @else
                            <td>-</td>
                            <td>-</td>
                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>



@endsection

