@extends('layouts.agentMiss')

@section('content')

    <script>
        document.getElementById("demandes").style.backgroundColor = "white";
    </script>

<div style="margin: 2%; overflow-x: hidden; overflow-y: auto">
    <form class="mt-3" method="post" action="/mission/{{$mission->id}}/update" id="form">
        @csrf
        <div class="align-items-center">

            <fieldset>

                <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                    <legend class="mb-3 text-black-50">Edition de la demande</legend>
                    <div  class="form-group col-sm-6 col-md-5">
                        <div class="">
                            <div class="font-weight-bold">Mission <span class="text-danger">*</span></div>
                        </div>
                        <input type="text" name="objet" id="objet" value="{{ old('objet') ?? $mission->objet }}" required placeholder="entrez l'objet de la mission" value="{{ old('objet') }}" class="form-control @error('objet') is-invalid @enderror">
                        @error('objet')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('objet') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group offset-md-1 offset-sm-0 col-md-6 col-sm-6">
                        <div class="">
                            <div class="font-weight-bold">Valideur <span class="text-danger">*</span></div>
                        </div>
                        <select name="idValideur" required id="idValideur" class="selectpicker form-control @error('idValideur') is-invalid @enderror" @include('include.selectOption')>
                            <option value="" class="text-light">...</option>
                            @foreach($valideurs as $valideur)
                                <option value="{{$valideur->id}}" {{$valideur->id == old('idValideur') ? 'selected' : ($valideur->id == $mission->idValideur ? 'selected' : '') }}>
                                    {{$valideur->agent->nom}} {{$valideur->agent->prenom}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="demandeur" value="{{ Auth::user()->id }}">

                    <div  class="form-group col-md-5 col-sm-6">
                        <div class="">
                            <div class="">
                                <div class="font-weight-bold">Date de départ <span class="text-danger">*</span></div>
                            </div>
                            <input type="date" name="dateDepart" value="{{ old('dateDepart') ?? $mission->dateDepart->format('Y-m-d') }}" required id="dateDepart" class="form-control @error('dateDepart') is-invalid @enderror">
                        </div>
                        @error('dateDepart')
                        <div class="invalide-feedBack() text-danger">
                            {{ $errors->first('dateDepart') }} date invalide
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-6 offset-sm-0 offset-md-1">
                        <div class="font-weight-bold">Ville de départ <span class="text-danger">*</span></div>
                        <div class="">
                            <select name="villeDepart" required id="villeDepart" class="selectpicker form-control @error('villeDepart') is-invalid @enderror" @include('include.selectOption')>
                                <option value="" class="text-light">...</option>
                                @foreach($villes as $ville)
                                    <option value="{{$ville->id}}" {{$ville->id == old('villeDepart') ? 'selected' : ($ville->id == $mission->villeDepart ? 'selected' : '') }}>
                                        {{$ville->nom}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('villeDepart')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('villeDepart') }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group  col-md-5 col-sm-6">
                        <div class="">
                            <div class="">
                                <div class="font-weight-bold">Date de rétour <span class="text-danger">*</span></div>
                            </div>
                            <input type="date" name="dateRetour" required id="dateRetour" value="{{ old('dateRetour') ?? $mission->dateRetour->format('Y-m-d') }}" class="form-control @error('dateRetour') is-invalid @enderror">
                        </div>
                        @error('dateRetour')
                        <div class="invalide-feedBack() text-danger">
                            date invalide
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-6 offset-sm-0 offset-md-1">
                        <div class="font-weight-bold">Destination <span class="text-danger">*</span></div>
                        <div class="">
                            <select name="villeDest" required id="villeDest" class="selectpicker form-control @error('villeDest') is-invalid @enderror" @include('include.selectOption')>
                                <option value="" class="text-light">...</option>
                                @foreach($villes as $ville)
                                    <option value="{{$ville->id}}" {{ $ville->id == old('villeDest') ? 'selected' : ($ville->id == $mission->villeDest ? 'selected' : '') }}>
                                        {{$ville->nom}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('villeDest')
                        <div class="invalide-feedBack() text-danger">
                            destination incorrecte
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-md-5 col-sm-6">
                        <div class="">
                            <div class="font-weight-bold">Activité comptable <span class="text-danger">*</span></div>
                            <select name="idActivite" id="idActivite" class="selectpicker form-control @error('idActivite') is-invalid @enderror" @include('include.selectOption')>
                                <option value="" class="text-light">...</option>
                                @foreach($activites as $activite)
                                    <option value="{{$activite->code}}" {{ old('idActivite') == $activite->code ? 'selected' : ($mission->idActivite == $activite->code ? 'selected':'')}}>{{ $activite->designation }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('idActivite')
                        <div class="invalide-feedBack() text-danger">
                            code activité invalide
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-6 offset-sm-0 offset-md-1">
                        <div class="">
                            <div class="font-weight-bold">Entité <span class="text-danger">*</span></div>
                            <select name="idEntite" id="idEntite" class="selectpicker form-control @error('idEntite') is-invalid @enderror" @include('include.selectOption')>
                                <option value="" class="text-light">...</option>
                                @foreach($entites as $entite)
                                    <option value="{{$entite->id}}" {{ old('idEntite') == $entite->id ? 'selected' : ($mission->idEntite == $entite->id ? 'selected':'')}}>{{$entite->designation}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('idEntite')
                        <div class="invalide-feedBack() text-danger">
                            entité ou service invalide
                        </div>
                        @enderror
                    </div>

                    <div class="col-12 font-weight-bold">Souhaits de la demande</div>
                    <div  class="form-group col-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Véhicule</div>
                            </div>
                            <select name="typeV" id="typeV" class="custom-select form-control @error('typeV') is-invalid @enderror">
                                <option value="" class="text-light">...</option>
                                <option value="pool" {{ 'pool' == old('typeV') ? 'selected' : ('pool' == $mission->typeV ? 'selected' : '') }}>Véhicule de pool</option>
                                <option value="tournee" {{ 'tournee' == old('typeV') ? 'selected' : ('tournee' == $mission->typeV ? 'selected' : '') }}>Véhicule de tournée</option>
                            </select>
                        </div>
                        @error('typeV')
                        <div class="invalide-feedBack() text-danger">
                            information invalide
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Code</div>
                            </div>
                            <input type="codeV" name="codeV" id="codeV" value="{{ old('codeV') }}" class="form-control @error('codeV') is-invalid @enderror">
                        </div>
                        @error('codeV')
                        <div class="invalide-feedBack() text-danger">
                            véhicule inexistant
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-5">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Chauffeur</div>
                            </div>
                            <select name="idChauf" id="idChauf" class="selectpicker form-control @error('idChauf') is-invalid @enderror" @include('include.selectOption')>
                                <option value="" class="text-light">...</option>
                                @foreach($chauffeurs as $chauffeur)
                                    <option value="{{$chauffeur->matricule}}" {{ $chauffeur->matricule == old('idChauf') ? 'selected' : ($chauffeur->matricule == $mission->idChauf ? 'selected' : '') }}>{{$chauffeur->nom}} {{$chauffeur->prenom}} ({{$chauffeur->matricule}})</option>
                                @endforeach
                            </select>
                        </div>
                        @error('idChauf')
                        <div class="invalide-feedBack() text-danger">
                            Chauffeur introuvable
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-12 ">
                        <div class="">
                            <div class="font-weight-bold">Participants <span class="text-danger">*</span></div>
                        </div>
                        <select name="agent[]" id="" required class="selectpicker form-control" multiple="" @include('include.selectOption')>
                            @foreach($agents as $agent)
                                <option value="{{$agent->matricule}}" {{$agent->matricule == old('agent[]') ? 'selected' : ( in_array($agent->matricule, $tab) ? 'selected' : '')}}>{{$agent->nom}} {{$agent->prenom}} ({{$agent->matricule}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div  class="form-group col-12 mt-3">
                        <div class="">
                            <div class="font-weight-bold">Pool de réception <span class="text-danger">*</span></div>
                        </div>
                        <select name="idPool" required id="idPool" class="selectpicker form-control @error('idPool') is-invalid @enderror" @include('include.selectOption')>
                            <option value="" class="text-light">...</option>
                            @foreach($pools as $pool)
                                <option value="{{$pool->id}}" {{$pool->id == old('idPool') ? 'selected' : ($pool->id == $mission->idPool ? 'selected' : '') }}>
                                    {{$pool->designation}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div  class="form-group col-12 ">
                        <label for="commentaire" class="ml-1 font-weight-bold">Infos supplémentaires</label>
                        <textarea name="commentaire" id="commentaire" value="{{ old('commentaire') ?? $mission->commentaire }}" cols="30" rows="3" placeholder="informations supplémentaires.." value="{{ old('commentaire') }}" class="form-control @error('commentaire') is-invalid @enderror"></textarea>
                        @error('commentaire')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('commentaire') }}
                        </div>
                        @enderror
                    </div>

                    <a href="{{ route('agentMiss.index') }}">
                        <button type="submit" id="submitForm" class="btn btn-outline-danger mt-2 mr-1" style="">Retour</button>
                    </a>
                    <button type="submit" id="submitForm" class="btn btn-success mt-2" style="">Modifier</button>
                </div>
            </fieldset>
        </div>


    </form>
</div>

@endsection

@section('chosen')
    <script>
        $("#agentChosen").chosen({
            placeholder_text_multiple: "Selectionner les participants",
            no_results_text: "aucun resultat trouvé"
        });
    </script>
@endsection
