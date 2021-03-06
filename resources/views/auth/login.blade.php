<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-color: rgb(200,236,185);font-family: Georgia;">
    <div id="app">

        <div class="container mt-4 pt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-5" style="box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px;">
                        <div class="card-header bg-success text-center text-light h3" style="border-top-right-radius: 15px; border-top-left-radius: 15px;">
                            {{ config('app.name', 'Laravel') }}
                        </div>

                        <div class="card-body">

                            <div class="w-75 m-auto mt-3 h4 text-info">
                                <marquee behavior="" direction="">Bienvenue sur la plateforme de gestion des véhicules de mission !!</marquee>
                            </div>
                            <div class="mt-2">.</div>
                            @if( session()->get('error') )
                                <div class="alert alert-danger text-center text-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}" >
                                @csrf

                                <div class="form-group row">
                                    <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Nom d\'utilisateur ') }}</label>

                                    <div class="col-md-6">
                                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>

                                        @error('login')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Profil') }}</label>

                                    <div class="col-md-6">
                                        <select name="role" id="role" class="form-control">
                                            <option value="1"></option>
                                            <option value="1">Demandeur</option>
                                            <option value="2">Chargé des interventions</option>
                                            <option value="3">Chargé des imputations</option>
                                            <option value="4">Responsable de pool</option>
                                            <option value="5">Gestionnaire de parc</option>
                                            <option value="6">Administrateur</option>
                                            <option value="7">Valideur</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Se Connecter') }}
                                        </button>

                                        {{-- @if (Route::has('password.request'))
                                            <a class="btn btn-link text-success" href="{{ route('password.request') }}">
                                        {{ __('mot de passe oublié ?') }}
                                        </a>
                                        @endif --}}
                                    </div>
                                </div>
                            </form>
                            <div class="align-content-center mt-3" style="border: 1px solid black; border-radius: 15px; background-color: forestgreen">
                                <img style="margin-left: 20%; width: 60%" src="{{ asset('img/logo_sofitex.gif') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
