@extends('layouts.respPool')

@section('content')

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
                <th scope="row" class="text-black-50">Participant (s) :</th>
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

        <hr class="mt-3">

        <form class="mt-3" method="post" action="{{route('attribution.store', '')}}" id="form">

            @csrf
            <div class="align-items-center">

                <div class="form-row" >

                    <div class="col-3"></div>
                    <div  class="form-group col-6">

                        <input type="hidden" name="idMission" value="{{ $mission->id }}">

                        <div class="">
                            <label for="idVehicule" class="text-black-50">Véhicule :</label>
                            <select name="idVehicule" required id="idVehicule" class="text-info custom-select @error('idVehicule') is-invalid @enderror">

                                <option value="">__choisir__</option>

                                @foreach($vehicules as $vehicule)
                                    <option value="{{ $vehicule->code }}">{{ $vehicule->code }}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('idVehicule')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('idVehicule') }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-3"></div>

                    <div class="col-12"></div>

                    <div class="col-3"></div>
                    <div  class="form-group col-6">

                        <div class="">
                            <label for="idChauffeur" class="text-black-50">Chauffeur :</label>
                            <select name="idChauffeur" id="idChauffeur" class="text-info custom-select @error('idChauffeur') is-invalid @enderror">
                                <option value="">__choisir__</option>
                                <option value="preventive">Maintenance préventive</option>
                                <option value="curative">Maintenance curative</option>
                            </select>
                        </div>
                        @error('idChauffeur')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('idChauffeur') }}
                        </div>
                        @enderror
                        <div class="text-warning">* Optionnel pour les véhicules ayant un chauffeur affecté</div>
                    </div>
                    <div class="col-3"></div>

                    <div class="col-12"></div>

                    <div class="col-3"></div>
                    <div  class="form-group col-6">

                        <div class="">
                            <label for="idEntite" class="text-black-50">Imputation :</label>
                            <select name="idEntite" required id="idEntite" class="text-info custom-select @error('idEntite') is-invalid @enderror">
                                <option value="">__choisir__</option>
                                <option value="preventive">DSI</option>
                                <option value="curative">BTM</option>
                                <option value="curative">Projet AIC</option>
                            </select>
                        </div>
                        @error('idEntite')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('idEntite') }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-3"></div>

                </div>

                <button type="submit" id="submitForm" class="btn btn-success mt-1" style="margin-left: 25%;">Valider</button>

            </div>
        </form>

    </div>

@endsection
