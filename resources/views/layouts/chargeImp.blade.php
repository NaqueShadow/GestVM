<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{asset('bootstrap-4.5.2/css/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="{{asset('bootstrap-4.5.2/css/bootstrap.min.css')}}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
</head>

<body class="" style="background-color: rgb(17,176,17);">

<div class="container">
    <div class="bg-succes" style="width: 100%">
        <section id="container">
            <!--header start-->
            <header class="container header navbar navbar-expand-lg border-bottom" style="background-color: rgb(220,220,220);">
                <div class="fa-bars">
                    <button class="btn btn-success fa fa-bars tooltips" data-placement="right" id="menu-toggle">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-list-nested" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5z"/>
                        </svg>
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
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle h6 text-success" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->agent->nom }} {{ Auth::user()->agent->prenom }}
                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                        <div class="sidebar-heading mb-5">

                        </div>
                        <div class="list-group list-group-flush mt-5">
                            <div class="h5 text-center" style="color: #284563;">POOL COMMUN</div>
                            <a href="#" class="list-group-item list-group-item-action h6 text-success" >Missions</a>
                            <a href="#" class="list-group-item list-group-item-action h6 text-success">Véhicules</a>
                            <a href="#" class="list-group-item list-group-item-action h6 text-success">Chauffeurs</a>
                            <a href="#" class="list-group-item list-group-item-action h6 text-success"></a>
                        </div>
                        <div class="list-group list-group-flush mt-5">
                            <div class="h5 text-center" style="color: #284563;">PARC SOFITEX</div>
                            <a href="#" class="list-group-item list-group-item-action h5 text-success ">Imputations</a>
                            <a href="#" class="list-group-item list-group-item-action h5 text-success">Chauffeurs</a>
                            <a href="#" class="list-group-item list-group-item-action h5 text-success">Véhicules</a>
                            <a href="#" class="list-group-item list-group-item-action h5 text-success">Pools</a>
                            <a href="#" class="list-group-item list-group-item-action h5 text-success"></a>
                        </div>
                    </div>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->

            <!--main content start-->
            <section id="main-content" style="background-color: white;">
                <section class="wrapper">
                    <div class="row">

                        <!-- /col-lg-3 -->

                        <div class="ml-3" style="min-height: 1000px">
                            @yield('content')
                        </div>

                    </div>
                    <!-- /row -->
                </section>
            </section>
            <!--main content end-->


            <!--footer start-->
            <footer class="site-footer">

            </footer>
            <!--footer end-->
        </section>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Menu Toggle Script -->
    <script src="lib/common-scripts.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</div>
</body>

</html>

