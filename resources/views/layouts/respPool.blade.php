<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | Responsable de pool</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/accordion.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{asset('bootstrap-4.5.2/css/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/accordion.js') }}" defer></script>

    <link rel="stylesheet" href="{{asset('bootstrap-4.5.2/css/bootstrap.min.css')}}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/chosen/chosen.css') }}" rel="stylesheet">
</head>

<body class="" style="background-color: rgb(17,176,17);">

<div class="container">
    <div class="bg-succes" style="width: 100%">
        <section id="container">
            <!--header start-->
            <header class="container header navbar navbar-expand-lg border-bottom" style="background-color: rgb(220,220,220);">
                <div class="fa-bars">
                    <button class="btn btn-success btn-round ml-4 tooltips" data-placement="right" id="menu-toggle">
                        <h3>{{ config('app.name', 'Laravel') }}</h3>
                    </button>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
                        </li>
                        <div class="mt-2 mr-2 text-primary" style="font-size: 1.5em;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="indianred" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                            </svg>{{\App\Models\Mission::new()}}
                        </div>
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle h5 text-success" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->agent->nom }} {{ Auth::user()->agent->prenom }}
                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-info" href="{{ route('agentMiss.index') }}">
                                    {{ __('missionnaire') }}
                                </a>

                                @if(Auth::user()->role == 4 and Auth::user()->idPool == 1)
                                    <a class="dropdown-item text-info" href="{{ route('gestParc.index') }}">
                                        {{ __('gestionnaire du parc') }}
                                    </a>
                                @endif

                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Se deconnecter') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </ul>
                </div>
            </header>
            <!--header end-->

            <!--sidebar start-->
            <aside class="">
                <div id="sidebar" class="nav-collapse  pl-2" style="background-color: rgb(220,220,220);">
                    <!-- sidebar menu start-->
                    <div class="border-right sidebar" id="sidebar-wrapper">
                        <div class="sidebar-heading">

                        </div>

                        <div class="list-group list-group-flush mt-3">
                            <div class="h5 text-center" style="color: #284563;"></div>
                            {{--
                            <a href="{{route('respPool.index')}}"
                            class="list-group-item list-group-item-action h5 text-success">Tableau de bord</a>
                            --}}
                            <a href="{{route('respPool.attrEnCours')}}" id="affectations" class="list-group-item list-group-item-action h5 text-success" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-clipboard" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                    <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                </svg>
                                Affectations
                            </a>
                            <a href="{{route('respPool.requetes')}}" id="demandes" class="list-group-item list-group-item-action h5 text-success" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-chat-text" viewBox="0 0 16 16">
                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                    <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                Demandes <span class="text-primary">({{\App\Models\Mission::new()}})</span>
                            </a>
                            <a href="{{route('respPool.vehicules')}}" id="vehicules" class="list-group-item list-group-item-action h5 text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-truck" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                </svg>
                                Véhicules
                            </a>
                            <a href="{{route('respPool.chauffeurs')}}" id="chauffeurs" class="list-group-item list-group-item-action h5 text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-people" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1h7.956a.274.274 0 0 0 .014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 0 0 .022.004zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                </svg>
                                Chauffeurs
                            </a>
                            <a href="#" class="list-group-item list-group-item-action h5 text-success"></a>
                        </div>

                        <div class="align-content-center mt-5" style="">
                            <img style="width: 180px; height: 7%; border-radius: 49%;" src="{{ asset('img/logoSofitex.jpg') }}" alt="">
                        </div>

                        <div class="text-dark text-center">&copy Copyright_Sofitex 2020</div>
                    </div>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->

            <!--main content start-->
            <section id="main-content" style="background-color: white;">
                <section class="wrapper">
                    <div class="">

                        <div class="ml-3" style="min-height: 1000px">
                            @yield('content')
                        </div>

                    </div>

                </section>
            </section>
            <!--main content end-->


            <!--footer start-->
            <footer class="site-footer">
                <div class="text-dark text-center">&copy Copyright_Sofitex 2020</div>
            </footer>
            <!--footer end-->
        </section>
    </div>

    <!-- Menu Toggle Script -->
    <script src="lib/common-scripts.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('lib/chosen/chosen.jquery.js') }}" type="text/javascript"></script>

    @yield('chosen')

</div>
</body>

</html>

