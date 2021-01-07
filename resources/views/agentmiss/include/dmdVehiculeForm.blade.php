

        <div class="align-items-center">

            <fieldset>

                <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                    <legend>Informations sur la mission</legend>
                    <div  class="form-group input-group col-8">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Objet</div>
                        </div>
                        <input type="text" name="objet" id="objet" value="{{ old('objet') ?? $mission->objet }}" required placeholder="entrez l'objet de la mission" value="{{ old('objet') }}" class="form-control @error('objet') is-invalid @enderror">
                        @error('objet')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('objet') }}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group input-group col-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text" title="nombre de participant">Nb. Participant</div>
                        </div>
                        <input type="number" min="1" max="15" required name="nbr" value="{{ old('nbr') ?? $mission->nbr }}" required id="nbr" value="{{ old('nbr') }}" class="form-control ">
                    </div>

                    <input type="hidden" name="demandeur" value="{{ Auth::user()->id }}">

                    <div  class="form-group col-5">
                        <div class="input-group ">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Depart</div>
                        </div>
                        <input type="date" name="dateDepart" value="{{ old('dateDepart') ?? $mission->dateDepart->format('Y-m-d') }}" required id="dateDepart" class="form-control @error('dateDepart') is-invalid @enderror">
                        </div>
                        @error('dateDepart')
                        <div class="invalide-feedBack() text-danger">
                            {{ $errors->first('dateDepart') }} date invalide
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-7">

                        <div class="">
                            <select name="villeDepart" required id="villeDepart" class="custom-select @error('villeDepart') is-invalid @enderror">

                                <option value="">--selectionner la ville de depart--</option>

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

                    <div  class="form-group  col-5">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Retour</div>
                        </div>
                        <input type="date" name="dateRetour" required id="dateRetour" value="{{ old('dateRetour') ?? $mission->dateRetour->format('Y-m-d') }}" class="form-control @error('dateRetour') is-invalid @enderror">
                        </div>
                        @error('dateRetour')
                        <div class="invalide-feedBack() text-danger">
                            date invalide
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col-7">

                        <div class="">
                            <select name="villeDest" required id="villeDest" class="custom-select @error('villeDest') is-invalid @enderror">

                                <option value="">--selectionner la destination--</option>

                                @foreach($villes as $ville)
                                    <option value="{{$ville->id}}" {{$ville->id == old('villeDest') ? 'selected' : ($ville->id == $mission->villeDest ? 'selected' : '') }}>
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

                    <div  class="form-group col-12 ">
                        <label for="commentaire" class="ml-1">Infos supplementaires :</label>
                        <textarea name="commentaire" id="commentaire" value="{{ old('commentaire') ?? $mission->commentaire }}" cols="30" rows="4" placeholder="informations supplémentaires.." value="{{ old('commentaire') }}" class="form-control @error('commentaire') is-invalid @enderror"></textarea>
                        @error('commentaire')
                        <div class="invalide-feedBack()">
                            {{ $errors->first('commentaire') }}
                        </div>
                        @enderror
                    </div>

                </div>

            </fieldset>

        </div>

