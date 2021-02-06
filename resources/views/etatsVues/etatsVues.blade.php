<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('bootstrap-4.5.2/css/bootstrap.min.css')}}">

</head>

<body class="bg-white" >
    <section style="">
        <div class="container">
            <div class="row">
                <div class="row col-2 align-content-center" style="">
                    <img class="col-auto" style="width: 180px;  border-radius: 49%;" src="{{ asset('img/logoSofitex.jpg') }}" alt="">
                </div>
                <div class="col-12">
                    <h3 class="text-center mt-3 ml-5 pl-5" style="border-bottom: 2px solid black;">SOCIETE BURKINABE DES FIBRES TEXTILES</h3>
                </div>
            </div>

            <div class="" >
                @yield('content')
            </div>
        </div>
    </section>
</body>

</html>

