@extends('layouts.valideur')

@section('content')

    <script>
        @if($mission->validation != 'Aucun avis')
            document.getElementById("validations").style.backgroundColor = "white";
        @else
            document.getElementById("demandes").style.backgroundColor = "white";
        @endif
    </script>

    <div class="mt-3 ml-5 mr-5 row align-content-center">
        <div class="col"></div>
        <div class="col-auto">
            <form method="post" action="{{ route('pdf.demande', ['mission' => $mission->id]) }}">
                @csrf
                <button type="submit" class="btn btn-link col-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indianred" class="bi bi-chat-text" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg> Pdf
                </button>
            </form>
        </div>
    </div>
    <div class="mt-2 ml-5 mr-5 align-content-center text-dark" style="overflow-y: auto; padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px; color: #284563;" >

        @if( session()->get('info') )
            <div class="alert alert-success text-center text-success">
                {{ session()->get('info') }}
            </div>
            <hr class="mt-3">
        @endif

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Demandeur :</div>
            <div class="col-8 form-control">{{ $mission->dmdeur->agent->nom }} {{ $mission->dmdeur->agent->prenom }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Mission :</div>
            <div class="col-6 form-control">{{ $mission->objet }}</div>
            <div class="col-2 text-primary form-control">[{{ $mission->validation }}]</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Trajet :</div>
            <div class="col-6 form-control">{{ $mission->villeDep->nom }} - {{ $mission->villeDesti->nom }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Depart :</div>
            <div class="col-3 form-control">{{ $mission->dateDepart->format('d/m/Y') }}</div>
            <div class="col-2 text-right font-weight-bold">Retour :</div>
            <div class="col-3 form-control">{{ $mission->dateRetour->format('d/m/Y') }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Activité comptable :</div>
            <div class="col-8 form-control">{{ isset($mission->idActivite)?$mission->activite->designation:'-' }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Entité :</div>
            <div class="col-8 form-control">{{ isset($mission->idEntite)?$mission->entite->designation:'-' }}</div>
        </div>

        @if(!empty($mission->typeV) || !empty($mission->codeV) || !empty($mission->idChauf))
                <div class="row mt-4">
                    <div class="col-3 text-right font-weight-bold">Préférence :</div>
                    <div class="col-3 form-control">
                        @if($mission->typeV)
                            Véhicule de {{ $mission->typeV }}
                        @endif
                    </div>
                    <div class="col-2 text-right font-weight-bold">Code :</div>
                    <div class="col-3 form-control">{{ $mission->codeV }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-6"></div>
                    <div class="col-2 text-right font-weight-bold">Chauffeur :</div>
                    <div class="col-3 form-control">
                        @if($mission->idChauf)
                            {{ $mission->chauffeur->nom }} {{ $mission->chauffeur->prenom }} ({{ $mission->chauffeur->matricule }})
                        @endif
                    </div>
                </div>
        @endif

        <div class="row mt-4">
            <div class="col-3 text-right font-weight-bold">Participant(s) :</div>
            <div class="col-9 text-right"></div>
            @foreach($mission->agents as $agent)
                <div class="col-3 text-right"></div>
                <div class="col-3">- {{ $agent->nom }} {{ $agent->prenom }}</div>
                <div class="col-6">{{ $agent->matricule }}</div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-3 text-right font-weight-bold">Pool de reception :</div>
            <div class="col-8 form-control">{{ isset($mission->idPool)?$mission->pool->designation:'-' }}</div>
        </div>

        @isset($mission->commentaire)
            <div class="row mt-4">
                <div class="col-3 text-right font-weight-bold">Commentaire :</div>
                <div class="col">{{ $mission->commentaire }}</div>
            </div>
        @endisset

        <hr class="mt-3">

        <div class="row">
            <div class="col">
                @if(empty($mission->attributions->first()))
                    <button type="button" class="btn btn-info mt-1 mb-1" data-toggle="modal" data-target="#fenetre">
                        Corriger
                    </button>
                @endif

                @if($mission->validation != 'Validée' && $mission->idEntite && $mission->idActivite)
                <form method="post" action="{{ route('valideur.valider', ['mission' => $mission->id]) }}" style="display: inline;">
                    @csrf
                    <input type="hidden" name="validation" value="valide">
                    <button class="btn btn-success" title="valider la demande">
                        Valider
                    </button>
                </form>
                @endif

                @if($mission->validation != 'Invalidée' && empty($mission->attributions->first()) &&$mission->idEntite && $mission->idActivite)
                <form method="post" action="{{ route('valideur.valider', ['mission' => $mission->id]) }}" style="display: inline;">
                    @csrf
                    <input type="hidden" name="validation" value="invalide">
                    <button class="btn btn-warning" title="invalider la demande">
                        Invalider
                    </button>
                </form>
                @endif
            </div>
        </div>

    </div>

    <div>
        <div class="modal fade" id="fenetre" tabindex="-1" aria-labelledby="fenetre" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Correction de la demande</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="mt-3" method="post" action="{{route('valideur.corriger', ['mission' => $mission->id])}}" id="form">
                            @method('PATCH')
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
                                                <select name="idActivite" id="idActivite" required class="selectpicker form-control @error('idActivite') is-invalid @enderror" @include('include.selectOption')>
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
                                                <select name="idEntite" id="idEntite" required class="selectpicker form-control @error('idEntite') is-invalid @enderror" @include('include.selectOption')>
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
                                                <input type="codeV" name="codeV" id="codeV" value="{{ old('codeV') ?? $mission->codeV }}" class="form-control @error('codeV') is-invalid @enderror">
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

                                        <div class="form-group col-12 ">
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
                                            <label for="commentaire" class="ml-1 font-weight-bold">Infos supplémentaires :</label>
                                            <textarea name="commentaire" id="commentaire" value="{{ old('commentaire') ?? $mission->commentaire }}" cols="30" rows="3" placeholder="informations supplémentaires.." value="{{ old('commentaire') }}" class="form-control @error('commentaire') is-invalid @enderror"></textarea>
                                            @error('commentaire')
                                            <div class="invalide-feedBack()">
                                                {{ $errors->first('commentaire') }}
                                            </div>
                                            @enderror
                                        </div>

                                        <button type="submit" id="submitForm" class="btn btn-success mt-2" style="">Modifier</button>
                                    </div>
                                </fieldset>
                            </div>
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

