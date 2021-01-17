<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('bootstrap-4.5.2/css/bootstrap.min.css')}}">
</head>

<body class="" style="background-color: rgb(200,236,185);">
    <div>
            <div class="card-body row">

                <h1 class="text-warning text-center col-12">Un problème a été rencontré !!!</h1>

            </div>
    </div>
</body>
</html>


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('vous avez déjà une session ouverte!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
