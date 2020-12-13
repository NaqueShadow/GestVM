@extends('layouts.agentMiss')

@section('content')

    <form class="w-75" method="post" action="{{route('mission.store')}}" id="form" style="margin-left: 12%;">

        @csrf
        <div class="form-row align-items-center ">

            <div class="col form-group mt-5 mb-2" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
                <h6 class="text-center mb-2 text-light"></h6>
                <fieldset>
                    <legend>Les participants de la mission</legend>
                    <small class="text-danger h6 mb-2" style="margin-left: 30%">ajout d'au moins un participant obligatoire*</small>
                    <div  class="form-group input-group">
                        <!-- <div class="input-group-prepend">
                            <div class="input-group-text">1.</div>
                        </div> -->
                        <div class="w-100">
                            <select name="ag1" id="ag1" required class="custom-select @error('ag1') is-invalid @enderror">

                                <option value="">__ajouter un participant__</option>

                                @foreach($agents as $agent)
                                    <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} __ matricule[ {{$agent->matricule}} ]</option>
                                @endforeach

                            </select>
                        </div>
                        @error('ag1')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('ag1') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group input-group">
                        <!-- <div class="input-group-prepend">
                            <div class="input-group-text">2.</div>
                        </div> -->
                        <div class="w-100">
                            <select name="ag2" id="ag2" class="custom-select @error('ag2') is-invalid @enderror">

                                <option></option>

                                @foreach($agents as $agent)
                                    <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} __ matricule[ {{$agent->matricule}} ]</option>
                                @endforeach

                            </select>
                        </div>
                        @error('ag2')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('ag2') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group input-group">
                        <!-- <div class="input-group-prepend">
                            <div class="input-group-text">3.</div>
                        </div> -->
                        <div class="w-100">
                            <select name="ag3" id="ag3" class="custom-select @error('ag3') is-invalid @enderror">

                                <option></option>

                                @foreach($agents as $agent)
                                    <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} __ matricule[ {{$agent->matricule}} ]</option>
                                @endforeach

                            </select>
                        </div>
                        @error('ag3')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('ag3') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group input-group">
                        <!-- <div class="input-group-prepend">
                            <div class="input-group-text">4.</div>
                        </div> -->
                        <div class="w-100">
                            <select name="ag4" id="ag4" class="custom-select @error('ag4') is-invalid @enderror">

                                <option></option>

                                @foreach($agents as $agent)
                                    <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} __ matricule[ {{$agent->matricule}} ]</option>
                                @endforeach

                            </select>
                        </div>
                        @error('ag4')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('ag4') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group input-group">
                        <!-- <div class="input-group-prepend">
                            <div class="input-group-text bg-success">5.</div>
                        </div> -->
                        <div class="w-100">
                            <select name="ag5" id="ag5" class="custom-select @error('ag5') is-invalid @enderror">

                                <option></option>

                                @foreach($agents as $agent)
                                    <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} __ matricule[ {{$agent->matricule}} ]</option>
                                @endforeach

                            </select>
                        </div>
                        @error('ag5')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('ag5') }}
                        </div>
                        @enderror
                    </div>
                </fieldset>
            </div>
        </div>

        <button type="" id="" class="btn btn-info mr-2" >< Retour</button>
        <button type="submit" id="submitForm" class="btn btn-success" >Soumettre ></button>

    </form>

@endsection
