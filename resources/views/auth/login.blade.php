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

        <div class="container mt-5 pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-5" style="box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px;">
                        <div class="card-header bg-success text-center text-light h3" style="border-top-right-radius: 15px; border-top-left-radius: 15px;">
                            {{ config('app.name', 'Laravel') }}
                        </div>

                        <div class="card-body">

                            @if( session()->get('error') )
                                <div class="alert alert-danger text-center text-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse Mail ') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                    <div class="col-md-6">
                                        <small class="text-black-50">* 8 caractères au moins</small>
                                        <input id="password" minlength="8" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember"
                                                   title="rester connecté tant que le navigateur n'est pas fermé">
                                              {{ __('Garder la session ouverte') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                --}}

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
