@extends('layouts.respPool')

@section('content')

    <script>
        document.getElementById("demandes").style.backgroundColor = "white";
    </script>

    <div class="mt-2 ml-5 mr-5 align-content-center text-dark" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px; color: #284563; overflow: auto;" >

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Demandeur :</div>
            <div class="col-3 form-control">{{ $mission->dmdeur->agent->nom }} {{ $mission->dmdeur->agent->prenom }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Mission :</div>
            <div class="col-8 form-control">{{ $mission->objet }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Trajet :</div>
            <div class="col-8 form-control">{{ $mission->villeDep->nom }} - {{ $mission->villeDesti->nom }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Depart :</div>
            <div class="col-2 form-control">{{ $mission->dateDepart->format('d/m/Y') }}</div>
            <div class="col-2 text-right font-weight-bold">Retour :</div>
            <div class="col-4 form-control">{{ $mission->dateRetour->format('d/m/Y') }}</div>
        </div>

        <div class="row mt-3">
            <div class="col-3 text-right font-weight-bold">Valideur :</div>
            <div class="col-3 form-control">{{ $mission->valideur->agent->nom }} {{ $mission->valideur->agent->prenom }}</div>
            <div class="col-2 text-right font-weight-bold">Avis :</div>
            <div class="col-3 form-control text-primary">[ {{ $mission->validation }} ]</div>
        </div>

        @if(!empty($mission->typeV) || !empty($mission->codeV) || !empty($mission->idChauf))
            <div class="row mt-3">
                <div class="col-3 text-right font-weight-bold">Préférence :</div>
                <div class="col-3 form-control">Véhicule de {{ $mission->typeV }}</div>
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
                <div class="col-6">{{ $agent->poste }}</div>
            @endforeach
        </div>

        @isset($mission->commentaire)
            <div class="row mt-4">
                <div class="col-3 text-right font-weight-bold">Commentaire :</div>
                <div class="col-8 form-control">{{ $mission->commentaire }}</div>
            </div>
        @endisset

        @if( session()->get('info') )
            <div class="alert alert-success text-center text-success">
                {{ session()->get('info') }}
            </div>
        @endif

        <hr class="mt-3">

        <section class="ac-container">
            <div>
                <input id="ac-2" name="accordion-1" type="checkbox" />
                <label class="text-dark" for="ac-2">Attribuer un véhicule ayant un chauffeur disponible</label>
                <article class="ac-large" style="overflow-y: auto">
                    <form class="mt-3" method="post" action="{{ route('attribution.store') }}" id="form">

                        @csrf
                        <div class="align-items-center">

                            <div class="form-row ml-1 mr-1" >
                                <input type="hidden" name="idMission" value="{{ $mission->id }}">

                                <div  class="form-group col-7">
                                    <div class="">
                                        <div for="idEntite" class="text-black-50">Imputation :</div>
                                        <select name="idEntite" required id="idEntite" class="selectpicker form-control" @include('include.selectOption')>
                                            <option value=""></option>
                                            @foreach($entites as $entite)
                                                <option value="{{$entite->id}}" {{$entite->id == old('idEntite') ? 'selected' : ''}}>{{$entite->designation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-7"></div>

                                <div  class="form-group col-8">
                                    <div class="">
                                        <div for="idVehicule" class="text-black-50">Véhicule :</div>
                                        <select name="idVehicule"  required id="idVehicule" class="selectpicker form-control text-info" @include('include.selectOption')>
                                            <option value=""></option>
                                            @foreach($vehicules as $vehicule)
                                                <option value="{{ $vehicule->code }}" {{ $vehicule->code == old('idVehicule') ? 'selected' : '' }}>{{ $vehicule->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div  class="form-group col-">
                                    <input type="hidden" name="idChauf" value="0">
                                </div>

                            </div>

                            <button type="submit" id="submitForm" class="btn btn-success ml-1" style="width: 20%" >Valider</button>

                        </div>
                    </form>
                </article>
            </div>
            <div>
                <input id="ac-3" name="accordion-1" type="checkbox" />
                <label for="ac-3" class="text-dark">Attribuer un véhicule plus un chauffeur au choix</label>
                <article class="ac-large" style="overflow-y: scroll">
                    <form class="mt-3" method="post" action="{{ route('attribution.store2') }}" id="form">

                        @csrf
                        <div class="align-items-center">

                            <div class="form-row ml-1 mr-1" >
                                <input type="hidden" name="idMission" value="{{ $mission->id }}">

                                <div  class="form-group col-5">
                                    <div class="">
                                        <div for="idEntite" class="text-black-50">Imputation :</div>
                                        <select name="idEntite" required id="idEntite" class="selectpicker form-control text-info" @include('include.selectOption')>
                                            <option value=""></option>
                                            @foreach($entites as $entite)
                                                <option value="{{$entite->id}}" {{$entite->id == old('idEntite') ? 'selected' : ''}}>{{$entite->designation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-7"></div>

                                <div  class="form-group col-5">
                                    <div class="">
                                        <div for="idVehicule" class="text-black-50">Véhicule :</div>
                                        <select name="idVehicule" required id="idVehicule" class="selectpicker form-control text-info" @include('include.selectOption')>
                                            <option value=""></option>
                                            @foreach($vehicules2 as $vehicule)
                                                <option value="{{ $vehicule->code }}" {{ $vehicule->code == old('idVehicule') ? 'selected' : '' }}>{{ $vehicule->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div  class="form-group col-7">
                                    <div class="">
                                        <div for="idEntite" class="text-black-50">Chauffeur :</div>
                                        <select name="idChauf" id="idChauf" required class="selectpicker text-info @error('idChauf') is-invalid @enderror" @include('include.selectOption')>
                                            <option value=""></option>
                                            @foreach($chauffeurs2 as $chauffeur)
                                                <option value="{{ $chauffeur->matricule }}" {{ $chauffeur->matricule == old('idChauf') ? 'selected' : '' }}>{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submitForm" class="btn btn-success ml-1" style="width: 20%" >Valider</button>

                        </div>
                    </form>
                </article>
            </div>
            {{--<div>
                <input id="ac-4" name="accordion-1" type="checkbox" />
                <label for="ac-4" class="text-dark">Attribuer un véhicule disponibilisé</label>
                <article class="ac-large" style="overflow-y: scroll">
                    <form class="mt-3" method="post" action="{{ route('attribution.store2') }}" id="form">

                        @csrf
                        <div class="align-items-center">

                            <div class="form-row ml-1 mr-1" >
                                <input type="hidden" name="idMission" value="{{ $mission->id }}">

                                <div  class="form-group col-5">
                                    <div class="">
                                        <div for="idEntite" class="text-black-50">Imputation :</div>
                                        <select name="idEntite" data-placeholder="choisir une entité..." required id="idEntite" class="agentChosen text-info custom-select">
                                            <option value=""></option>
                                            @foreach($entites as $entite)
                                                <option value="{{$entite->id}}" {{$entite->id == old('idEntite') ? 'selected' : ''}}>{{$entite->designation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-7"></div>

                                <div  class="form-group col-5">
                                    <div class="">
                                        <div for="idVehicule" class="text-black-50">Véhicule :</div>
                                        <select name="idVehicule" @include('include.selectOption') required id="idVehicule" class="selectpicker text-info custom-select">
                                            <option value=""></option>
                                            @foreach($vehicules3 as $vehicule)
                                                <option value="{{ $vehicule->code }}" {{ $vehicule->code == old('idVehicule') ? 'selected' : '' }}>{{ $vehicule->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div  class="form-group col-7">
                                    <div class="">
                                        <div for="idChauf" class="text-black-50">Chauffeur :</div>
                                        <select name="idChauf" @include('include.selectOption') id="idChauf" class="selectpicker text-info custom-select @error('idChauf') is-invalid @enderror">
                                            <option value=""></option>
                                            @foreach($chauffeurs2 as $chauffeur)
                                                <option value="{{ $chauffeur->matricule }}" {{ $chauffeur->matricule == old('idChauf') ? 'selected' : '' }}>{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submitForm" class="btn btn-success ml-1" style="width: 20%" >Valider</button>

                        </div>
                    </form>
                </article>
            </div>--}}
        </section>

        <a href="{{ route('respPool.requetes') }}">
        <button type="submit" id="submitForm" class="btn btn-danger mt-1" style="">Terminer</button>
        </a>

    </div>

@endsection

