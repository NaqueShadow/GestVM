<!-- Button trigger modal -->
<button type="button" class="btn btn-success mt-2 mb-2" data-toggle="modal" data-target="#form">
    Nouvelle requête
</button>

<!-- Modal -- -->
<div class="modal fade" id="form" tabindex="-1" aria-labelledby="form" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="background-color: rgb(200,236,185);">
            <div class="modal-header" style="background-color: rgb(200,236,185);font-family: Georgia;">
                <h5 class="modal-title text-success" id="exampleModalLabel">Nouvelle requête</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="" method="post" action="{{route('mission.store')}}" id="form">

                    @csrf
                    <div class="form-row align-items-center">

                        <div class="col-7 form-row  border-right" style="margin-bottom: auto;">
                            <h6 class="text-light text-center mb-2 "></h6>
                            <div  class="form-group input-group col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Objet</div>
                                </div>
                                <input type="text" name="objet" id="objet" placeholder="Entrez l'objet de la mission objet" value="{{ old('objet') }}" class="form-control @error('objet') is-invalid @enderror">
                                @error('objet')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('objet') }}
                                </div>
                                @enderror
                            </div>

                            <input type="hidden" name="auteur" value="{{ Auth::user()->id }}">

                            <div  class="form-group input-group col-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Depart</div>
                                </div>
                                <input type="date" name="dateDepart" id="dateDepart" value="{{ old('dateDepart') }}" class="form-control @error('dateDepart') is-invalid @enderror">
                                @error('dateDepart')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('dateDepart') }}
                                </div>
                                @enderror
                            </div>

                            <div  class="form-group input-group col-8">
                                <div class="input-group-prepend w-25">
                                    <div class="input-group-text">Ville depart</div>
                                </div>
                                <div class="w-75">
                                    <select name="villeDepart" id="villeDepart" class="custom-select @error('villeDepart') is-invalid @enderror">

                                        <option value="">choisir la ville de depart</option>

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
                                <input type="date" name="dateRetour" id="dateRetour" value="{{ old('dateRetour') }}" class="form-control @error('dateRetour') is-invalid @enderror">
                                @error('dateRetour')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('dateRetour') }}
                                </div>
                                @enderror
                            </div>

                            <div  class="form-group input-group col-8">
                                <div class="input-group-prepend w-25">
                                    <div class="input-group-text">Destination</div>
                                </div>
                                <div class="w-75">
                                    <select name="villeDest" id="villeDest" class="custom-select @error('villeDest') is-invalid @enderror">

                                        <option value="">choisir la destination</option>

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
                                <label for="commentaire">Commentaire</label>
                                <textarea name="commentaire" id="comment" cols="30" rows="4" placeholder="commentaire.." value="{{ old('commentaire') }}" class="form-control @error('commentaire') is-invalid @enderror"></textarea>
                                @error('commentaire')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('commentaire') }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col form-group" style="margin-bottom: auto;">
                            <h6 class="text-center mb-2 text-light"></h6>
                            <div  class="form-group input-group ml-5">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">1.</div>
                                </div>
                                <div class="w-75">
                                    <select name="ag1" id="ag1" class="custom-select @error('ag1') is-invalid @enderror">

                                        <option value="">--ajouter un participant--</option>

                                        @foreach($agents as $agent)
                                            <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} -- [ {{$agent->matricule}} ]</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('ag1')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('ag1') }}
                                </div>
                                @enderror
                            </div>

                            <div  class="form-group input-group ml-5">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">2.</div>
                                </div>
                                <div class="w-75">
                                    <select name="ag2" id="ag2" class="custom-select @error('ag2') is-invalid @enderror">

                                        <option>--</option>

                                        @foreach($agents as $agent)
                                            <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} -- [ {{$agent->matricule}} ]</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('ag2')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('ag2') }}
                                </div>
                                @enderror
                            </div>

                            <div  class="form-group input-group ml-5">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">3</div>
                                </div>
                                <div class="w-75">
                                    <select name="ag3" id="ag3" class="custom-select @error('ag3') is-invalid @enderror">

                                        <option>--</option>

                                        @foreach($agents as $agent)
                                            <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} -- [ {{$agent->matricule}} ]</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('ag3')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('ag3') }}
                                </div>
                                @enderror
                            </div>

                            <div  class="form-group input-group ml-5">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">4</div>
                                </div>
                                <div class="w-75">
                                    <select name="ag4" id="ag4" class="custom-select @error('ag4') is-invalid @enderror">

                                        <option>--</option>

                                        @foreach($agents as $agent)
                                            <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} -- [ {{$agent->matricule}} ]</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('ag4')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('ag4') }}
                                </div>
                                @enderror
                            </div>

                            <div  class="form-group input-group ml-5">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">5</div>
                                </div>
                                <div class="w-75">
                                    <select name="ag5" id="ag5" class="custom-select @error('ag5') is-invalid @enderror">

                                        <option>--</option>

                                        @foreach($agents as $agent)
                                            <option value="{{$agent->matricule}}">{{$agent->nom}} {{$agent->prenom}} -- [ {{$agent->matricule}} ]</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('ag5')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('ag5') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submitForm" class="btn btn-success">Envoyer la requête</button>


                </form>
            </div>
        </div>
    </div>
</div>
