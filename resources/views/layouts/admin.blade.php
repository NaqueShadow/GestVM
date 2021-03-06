<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | Administrateur</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('bootstrap-4.5.2/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap-4.5.2/css/bootstrap-select.min.css')}}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
</head>

<body class="" style="background-color: rgb(17,176,17); min-width: 900px;">

<div class="container">
    <div class="bg-succes" style="width: 100%">
        <section id="container">
            <!--header start-->
            <header class="container header navbar navbar-expand-lg border-bottom" style="background-color: rgb(220,220,220);">
                <div class="fa-bars">
                    <button class="btn btn-success btn-round ml-4 tooltips" data-placement="right" id="menu-toggle">
                        <h3>{{ config('app.name', 'VM_SOFT') }}</h3>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle h5 text-success" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->agent->nom }} {{ Auth::user()->agent->prenom }}
                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-info text-center" href="{{ route('agentMiss.index') }}">
                                    {{ __('Demandeur') }}
                                </a>
                                @include('include.role')
                                <hr class="mt-1">
                                <a class="dropdown-item text-danger text-center" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                    </svg>
                                    {{ __('Se déconnecter') }}
                                </a>
                                <a class="dropdown-item text-warning text-center" data-toggle="modal" data-target="#passwd">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                    {{ __('Mot de passe') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </ul>
                </div>
            </header>

            <!--sidebar start-->
            <aside class="">
                <div id="sidebar" class="nav-collapse  pl-2" style="background-color: rgb(220,220,220);">
                    <!-- sidebar menu start-->
                    <div class="border-right sidebar" id="sidebar-wrapper">
                        <div class="sidebar-heading mb-5">

                        </div>

                        <div class="list-group list-group-flush mt-5">
                            <div class="h5 text-center" style="color: #284563;"></div>
                            <a href="{{ route('admin.index') }}" id="users" class="list-group-item list-group-item-action h5 text-success ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-chat-text" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                                Comptes
                            </a>
                            <a href="{{ route('admin.indexAgent') }}" id="agents" class="list-group-item list-group-item-action h5 text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-chat-text" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                </svg>
                                Agents
                            </a>
                            <a href="{{ route('activite.index') }}" id="entites" class="list-group-item list-group-item-action h5 text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-chat-text" viewBox="0 0 16 16">
                                    <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
                                </svg>
                                Entités
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

            <!--main content start-->
            <section id="main-content" style="background-color: white;">
                <section class="wrapper">

                    <div class="ml-2 vh-100">
                        @include('include.passInfo')
                        @yield('content')
                    </div>

                    @include('include.password')

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

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{asset('bootstrap-4.5.2/js/bootstrap-select.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });
    </script>


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

