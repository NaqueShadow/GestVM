@extends('layouts.admin')

@section('content')

    <script>
        document.getElementById("entites").style.backgroundColor = "white";
    </script>

    <div class="card mt-2 h-100 align-content-center text-dark" style="margin: auto; box-shadow: 1px 1px 2px mediumseagreen; border-radius: 15px; width: 100%;">

        <div class="card-header bg-light pt-0 pb-0">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link text-info h5" href="{{ route('activite.index') }}">Activités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info h5" href="{{ route('direction.index') }}">Directions</a>
                </li>
                <li class="nav-item bg-white">
                    <a class="nav-link text-success h5 active" href="{{ route('entite.index') }}">Entités (services)</a>
                </li>
            </ul>
        </div>

        <div class="card-body h-100" style="color: #284563; overflow: auto;">

            <div>
                <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">{{$entite->designation}}</h5>
                        </div>

                        <div class="modal-body">
                            <form class="mt-5" method="post" action="{{route('entite.update', ['entite' => $entite->id])}}" id="form">
                                @csrf
                                <div class="form-group input-group col-12 row">
                                    <label class="col-3 font-weight-bold">Libellé</label>
                                    <div class="col-9">
                                        <input type="text" name="designation" id="designation"
                                               value="{{ old('designation') ?? $entite->designation }}" required
                                               placeholder="..." value="{{ old('designation') }}"
                                               class="form-control @error('designation') is-invalid @enderror">
                                        @error('designation')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'libellé invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group input-group col-12 row">
                                    <label class="col-3 font-weight-bold">Abbréviation</label>
                                    <div class="col-9">
                                        <input type="text" name="abbreviation" id="abbreviation"
                                               value="{{ old('abbreviation') ?? $entite->abbreviation }}" required
                                               placeholder="..." value="{{ old('abbreviation') }}"
                                               class="form-control @error('abbreviation') is-invalid @enderror">
                                        @error('abbreviation')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'abbréviation invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group input-group col-12 row">
                                    <label class="col-3 font-weight-bold">Direction</label>
                                    <div class="col-9">
                                        <select name="idDirection" id="idDirection" required class="form-control @error('idDirection') is-invalid @enderror">
                                            <option value=""></option>
                                            @foreach($directions as $direction)
                                                <option value="{{ $direction->id }}" {{$direction->id==old('idDirection')?'selected':($entite->idDirection==$direction->id?'selected':'')}}>{{ $direction->designation }}</option>
                                            @endforeach
                                        </select>
                                        @error('idDirection')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'direction invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" id="submitForm" class="btn btn-success mt-2">Modifier</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <small></small>
                        </div>
                    </div>
            </div>

        </div>
    </div>
@endsection
