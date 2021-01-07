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

<body class="bg-warning">
    <div>
        <div class="card mt-5 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px;">
            <div class="card-header bg-light text-success h4">

            </div>

            <div class="card-body row">

                <h1 class="text-warning text-center">Un problème a été rencontré !!!</h1>

            </div>

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
