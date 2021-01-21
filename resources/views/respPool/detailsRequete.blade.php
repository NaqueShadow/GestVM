@extends('layouts.respPool')

@section('content')

    <script>
        document.getElementById("demandes").style.backgroundColor = "white";
    </script>

    <div class="mt-5 ml-5 mr-5 align-content-center text-dark" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px; color: #284563;" >

        <table class="table-sm text-info" style="min-width: 75%;">

            <tr>
                <th scope="row" class="text-black-50">Demandeur</th>
                <td>: {{ $mission->dmdeur->agent->nom }} {{ $mission->dmdeur->agent->prenom }} </td>
                <th scope="row"></th>
                <td> </td>
            </tr>

            <tr>
                <th scope="row" class="text-black-50">Mission</th>
                <td>: {{ $mission->objet }}</td>
                <th scope="row"></th>
                <td> </td>
            </tr>

            <div class="mt-3"></div>
            <tr>
                <th scope="row" class="text-black-50">Trajet</th>
                <td>: {{ $mission->villeDep->nom }}</td>
                <td >{{ $mission->villeDesti->nom }}</td>
                <td></td>
            </tr>
            <div class="mt-3"></div>
            <tr>
                <th scope="row" class="text-black-50">Depart</th>
                <td>: {{ $mission->dateDepart->format('d-m-Y') }}</td>
                <th scope="row" class="text-center text-black-50">Retour</th>
                <td>: {{ $mission->dateRetour->format('d-m-Y') }}</td>
            </tr>

            <tr class="mt-3"></tr>
            <tr class="pt-3">
                <th scope="row"></th>
                <th scope="row" class="text-black-50">Participant (s) : </th>
                <td></td>
                <td></td>
            </tr>
            @foreach($mission->agents as $agent)
            <div class="mt-3"></div>
            <tr>
                <th scope="row"></th>
                <td> </td>
                <td scope="row">{{ $agent->nom }} {{ $agent->prenom }}</td>
                <td class="text-black-50">{{ $agent->poste }}</td>
            </tr>
            @endforeach
        </table>

        @isset($mission->commentaire)
            <tr class="mt-2">
                <th scope="row" class="text-black-50">Commentaire</th>
                <td>: {{ $mission->commentaire }}</td>
            </tr>
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
                <article class="ac-large" style="overflow-y: scroll">
                    <form class="mt-3" method="post" action="{{ route('attribution.store') }}" id="form">

                        @csrf
                        <div class="align-items-center">

                            <div class="form-row ml-1 mr-1" >
                                <input type="hidden" name="idMission" value="{{ $mission->id }}">

                                <div  class="form-group col-7">
                                    <div class="">
                                        <div for="idEntite" class="text-black-50">Imputation :</div>
                                        <select name="idEntite" required @include('include.selectOption') id="idEntite" class="selectpicker text-info">
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
                                        <select name="idVehicule"  required id="idVehicule" class="selectpicker text-info" @include('include.selectOption')>
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
                                        <select name="idEntite" @include('include.selectOption') required id="idEntite" class="selectpicker text-info">
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
                                        <select name="idVehicule" @include('include.selectOption') required id="idVehicule" class="selectpicker text-info">
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
                                        <select name="idChauf" @include('include.selectOption') id="idChauf" required class="selectpicker text-info @error('idChauf') is-invalid @enderror">
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

