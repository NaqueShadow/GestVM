@extends('layouts.agentMiss')

@section('content')

    <script>
        document.getElementById("demandes").style.backgroundColor = "white";
    </script>

    <form class="w-75" method="post" action="{{route('mission.store')}}" id="form" style="margin-left: 12%;">

        @csrf
        <div class="form-row align-items-center ">

            <div class="col form-group mt-5 mb-2" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
                <h6 class="text-center mb-2 text-light"></h6>
                <fieldset>
                    <legend>Les participants de la mission</legend>

                    @for ($i = 0; $i < session('mission.nbr'); $i++)
                        <div  class="form-group input-group">
                        <!-- <div class="input-group-prepend">
                            <div class="input-group-text">1.</div>
                        </div> -->
                        <div class="w-100">
                            <select name="agent[]" id="agent[]" required class="custom-select @error('agent[]') is-invalid @enderror">

                                <option value="">__ajouter un participant__</option>

                                @foreach($agents as $agent)
                                    <option value="{{$agent->matricule}}" {{$agent->matricule == old('agent[]') ? 'selected' : ''}}>{{$agent->nom}} {{$agent->prenom}} __ matricule[ {{$agent->matricule}} ]</option>
                                @endforeach

                            </select>
                        </div>
                        @error('agent[]')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('agent[]') }}
                        </div>
                        @enderror
                    </div>
                    @endfor
                </fieldset>
            </div>
        </div>

        <button type="" id="" class="btn btn-info mr-2" >< Retour</button>
        <button type="submit" id="submitForm" class="btn btn-success" >Soumettre ></button>

    </form>

@endsection
