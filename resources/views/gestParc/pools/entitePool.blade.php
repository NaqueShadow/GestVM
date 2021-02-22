@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("pools").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">
        <div class="card-header bg-light pt-0 pb-0">
            <div class="row">
            <div class=" col text-success h4">Pool / {{$pool->designation}}</div>
                <div class="col-auto btn-group mr-0">
                    <a href="{{ route('pool.show', ['pool' => $pool->id]) }}"><button class="btn btn-light">Véhicules</button></a>
                    <a href="{{ route('pool.showChauf', ['pool' => $pool->id]) }}"><button class="btn btn-light">Chauffeurs</button></a>
                    <a href="{{ route('pool.showEntite', ['pool' => $pool->id]) }}"><button class="btn btn-light active">Entités</button></a>
                </div>
            </div>
        </div>

        <div class="card-body h-100" style="color: #284563; overflow: auto;">

            @if( session()->get('info') )
                <div class="alert alert-success text-center text-success">
                    {{ session()->get('info') }}
                </div>
            @endif

            <div class="modal-content">
                <form class="" method="post" action="{{ route('pool.ajoutEntite', ['pool' => $pool->id]) }}" id="form">
                    @csrf
                    <div class="align-items-center">
                        <div  class="form-group row ml-3 mt-2">
                            <select name="entite[]" id="" required class="col-10 selectpicker form-control" @include('include.selectOption') multiple >
                                @foreach($entites as $entite)
                                    <option value="{{$entite->id}}">{{$entite->designation}}</option>
                                @endforeach
                            </select>
                            <button type="submit" id="submitForm" class="ml-1 btn btn-success" >Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table table-hover table-striped">
                <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Entité</th>
                    <th scope="col">Direction</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @php
                    $i = 0;
                @endphp
                @foreach( $pool->entites as $entite )
                    <tr>
                        <th>{{ ++$i }}</th>
                        <th>{{ $entite->designation }}</th>
                        <td>{{ $entite->idDirection?$entite->direction->abbreviation:'' }}</td>
                        <td>
                            <form class="" method="post" action="{{ route('pool.retraitEntite', ['pool' => $pool->id]) }}" id="form">
                                @method('DELETE')
                                @csrf
                                <div  class="">
                                    <input type="hidden" name="entite" value="{{ $entite->id }}">
                                    <button type="submit" id="submitForm" class="p-1 btn btn-danger" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
