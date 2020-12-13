@extends('layouts.agentMiss')

@section('content')

<div style="margin: 2%;">
    <form class="mt-5" method="post" action="{{route('mission.initStore')}}" id="form">

        @csrf
        <div class="align-items-center">

            <fieldset>

                <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                    <legend>Information sur la mission</legend>
                    <div  class="form-group input-group col-12">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Objet</div>
                        </div>
                        <input type="text" name="objet" id="objet" required placeholder="entrez l'objet de la mission" value="{{ old('objet') }}" class="form-control @error('objet') is-invalid @enderror">
                        @error('objet')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('objet') }}
                        </div>
                        @enderror
                    </div>

                    <input type="hidden" name="demandeur" value="{{ Auth::user()->id }}">

                    <div  class="form-group input-group col-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Depart</div>
                        </div>
                        <input type="date" name="dateDepart" required id="dateDepart" value="{{ old('dateDepart') }}" class="form-control @error('dateDepart') is-invalid @enderror">
                        @error('dateDepart')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('dateDepart') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-8">

                        <div class="">
                            <select name="villeDepart" required id="villeDepart" class="custom-select @error('villeDepart') is-invalid @enderror">

                                <option value="">--selectionner la ville de depart--</option>

                                @foreach($villes as $ville)
                                    <option value="{{$ville->id}}">{{$ville->nom}}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('villeDepart')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('villeDepart') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group input-group col-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Retour</div>
                        </div>
                        <input type="date" name="dateRetour" required id="dateRetour" value="{{ old('dateRetour') }}" class="form-control @error('dateRetour') is-invalid @enderror">
                        @error('dateRetour')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('dateRetour') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-8">

                        <div class="">
                            <select name="villeDest" required id="villeDest" class="custom-select @error('villeDest') is-invalid @enderror">

                                <option value="">--selectionner la destination--</option>

                                @foreach($villes as $ville)
                                    <option value="{{$ville->id}}">{{$ville->nom}}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('villeDest')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('villeDest') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-12 ">
                        <label for="commentaire" class="ml-1">Commentaire :</label>
                        <textarea name="commentaire" id="comment" cols="30" rows="4" placeholder="informations supplémentaires.." value="{{ old('commentaire') }}" class="form-control @error('commentaire') is-invalid @enderror"></textarea>
                        @error('commentaire')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('commentaire') }}
                        </div>
                        @enderror
                    </div>

                </div>

            </fieldset>

        </div>

        <button type="submit" id="submitForm" class="btn btn-success mt-2" style="margin-left: 88%; width: 12%;">Suivant  ></button>

    </form>

</div>

@endsection
