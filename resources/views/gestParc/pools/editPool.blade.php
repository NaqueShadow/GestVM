@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("pools").style.backgroundColor = "white";
    </script>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Editer infos pool</h5>
            </div>

            <div class="modal-body">

                <form class="mt-5" method="post" action="{{route('pool.update', ['pool' => $pool->id])}}" id="form">

                    @csrf
                    <div class="align-items-center">

                        <fieldset>
                            <div class="form-row"
                                 style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                                <div class="form-group input-group col-12 row">
                                    <label class="col-3">Désignation</label>
                                    <div class="col-9">
                                        <input type="text" name="designation" id="designation"
                                               value="{{ old('designation') ?? $pool->designation }}" required
                                               placeholder="..." value="{{ old('designation') }}"
                                               class="form-control @error('designation') is-invalid @enderror">
                                        @error('designation')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'désignation déjà existant' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group input-group col-12 row">
                                    <label class="col-3">Abbréviation</label>
                                    <div class="col-9">
                                        <input type="text" name="abbreviation" id="abbreviation"
                                               value="{{ old('abbreviation') ?? $pool->abbreviation }}"
                                               required placeholder="..." value="{{ old('abbreviation') }}"
                                               class="form-control @error('abbreviation') is-invalid @enderror">
                                        @error('abbreviation')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'abbréviation déjà existant' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group input-group col-12 row">
                                    <label class="col-3">Région cotonnière</label>
                                    <div class="col-9">
                                        <select name="regionID" id="regionID" required class="form-control @error('regionID') is-invalid @enderror">
                                            <option value=""></option>
                                            @foreach($regions as $region)
                                                <option value="{{$region->id}}" {{old('regionId')==$region->id?'selected':($region->id==$pool->regionId?'selected':'')}}>{{$region->nom}}</option>
                                            @endforeach
                                        </select>
                                        @error('regionID')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'region invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </fieldset>

                    </div>

                    <button type="submit" id="submitForm" class="btn btn-success mt-2">Enregistrer</button>

                </form>

            </div>
        </div>
    </div>

@endsection
