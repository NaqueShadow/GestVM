@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("statistiques").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <ul class="nav nav-tabs">
                <li class="nav-item bg-white">
                    <a class="nav-link text-success h5 active" href="{{ route('stat.index') }}">Entités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info h5" href="{{ route('stat.indexActivite') }}">Activités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info h5" href="{{ route('stat.indexPool') }}">Pools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info h5" href="{{ route('stat.indexVehicule') }}">Véhicules</a>
                </li>
            </ul>
        </div>

        <div class="card-body h-100" style="color: #284563; overflow: auto;">
            <div class="">
                <form class="" method="post" action="{{route('stat.index')}}" id="form">
                    @csrf
                    <div  class="form-group form-row mb-0">
                        <div class="col"></div>
                        <select name="entite" id="entite" hidden class="col-3 form-control">
                            <option value="">Tous les utilisateurs</option>
                        </select>
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

            <hr class="mt-3">

            <div id="charts_container">

            </div>
        </div>
    </div>



@endsection

@section('charts')
    <script src="{{ asset('js/highcharts.js') }}"></script>

    <script type="text/javascript">
        var distances = {{ json_encode($tab2) }};
        var carburant = {{ json_encode($tab3) }};

        Highcharts.chart('charts_container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Consommation par Utilisateur (imputations)'
            },
            subtitle: {
                text: 'Utilisations mensuelles'
            },
            xAxis: {
                categories: [
                    @foreach($tab1 as $val)
                    '{{ urldecode($val) }}',
                    @endforeach
                ],
                crosshair: true
            },
            yAxis: [
                { //--- Primary yAxis
                    title: {
                        text: 'Kilomètres'
                    },
                    labels: {
                        formatter: function() {
                            return this.value + ' Km';
                        }
                    },
                },
                { //--- Secondary yAxis
                    title: {
                        text: 'Litres'
                    },
                    labels: {
                        formatter: function() {
                            return this.value + ' L';
                        }
                    },
                    opposite: true
                }
            ],

            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [
                {
                    yAxis: 0,
                    name: 'Km parcourus',
                    data: distances
                },
                {
                    yAxis: 1,
                    name: 'L carburant',
                    data: carburant
                }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@endsection
