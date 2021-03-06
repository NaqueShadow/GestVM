
<div class="align-items-center">

    <fieldset>
        <div class="form-row"
             style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

            <div class="form-group input-group col-12 row">
                <label class="col-3">Matricule</label>
                <div class="col-9">
                    <input type="text" name="matricule" id="matricule"
                           value="{{ old('matricule') ?? $agent->matricule }}" required
                           placeholder="..." value="{{ old('matricule') }}"
                           class="form-control @error('matricule') is-invalid @enderror">
                    @error('matricule')
                    <div class="invalide-feedBack() text-danger">
                        {{ 'matricule déjà inscrit dans la base de données' }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group input-group col-12 row">
                <label class="col-3">Nom</label>
                <div class="col-9">
                    <input type="text" name="nom" id="nom"
                           value="{{ old('nom') ?? $agent->nom }}"
                           required placeholder="..." value="{{ old('nom') }}"
                           class="form-control @error('nom') is-invalid @enderror">
                    @error('nom')
                    <div class="invalide-feedBack() text-danger">
                        {{ 'nom invalide' }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group input-group col-12 row">
                <label class="col-3">Prénom(s)</label>
                <div class="col-9">
                    <input type="text" name="prenom" id="prenom"
                           value="{{ old('prenom') ?? $agent->prenom }}" required
                           placeholder="..."
                           class="form-control @error('prenom') is-invalid @enderror">
                    @error('prenom')
                    <div class="invalide-feedBack() text-danger">
                        {{ 'prénom invalide' }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group input-group col-12 row">
                <label class="col-3">Poste</label>
                <div class="col-9">
                    <input type="text" name="poste" id="poste"
                           value="{{ old('poste') ?? $agent->poste }}" required
                           placeholder="..."
                           class="form-control @error('poste') is-invalid @enderror">
                    @error('poste')
                    <div class="invalide-feedBack() text-danger">
                        {{ 'Poste invalide' }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group input-group col-12 row">
                <label class="col-3">Service/Entité</label>
                <div class="col-9">
                    <select name="idEntite" id="idEntite" class="selectpicker form-control @error('idEntite') is-invalid @enderror" @include('include.selectOption')>
                        <option value="">...</option>
                        @foreach($entites as $entite)
                            <option value="{{$entite->id}}" {{$entite->id == old('idEntite')?'selected':($entite->id == $agent->idEntite?'selected':'')}}>
                                {{$entite->designation}}
                            </option>
                        @endforeach
                    </select>
                    @error('idEntite')
                    <div class="invalide-feedBack() text-danger">
                        {{ 'Poste invalide' }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group input-group col-12 row">
                <label class="col-3">Catégorie</label>
                <div class="col-9">
                    <select name="idCateg" id="idCateg" required class="form-control @error('idCateg') is-invalid @enderror">
                        <option value="">...</option>
                        @foreach($categories as $categorie)
                        <option value="{{$categorie->categorie}}" {{$categorie->categorie == old('idCateg')?'selected':($categorie->categorie == $agent->idCateg?'selected':'')}}>
                            {{$categorie->categorie}}
                        </option>
                        @endforeach
                    </select>
                    @error('idCateg')
                    <div class="invalide-feedBack() text-danger">
                        {{ 'Poste invalide' }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group input-group col-12 row">
                <label class="col-3">Email</label>
                <div class="col-9">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $agent->email }}"
                           placeholder="..." required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ 'déjà existant' }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group input-group col-12 row">
                <label class="col-3">Contact</label>
                <div class="col-9">
                    <small class="text-info">* huit chiffres</small>
                    <input type="tel" name="telephone" id="telephone"
                           value="{{ old('telephone') ?? $agent->telephone }}" required
                           placeholder="..." pattern="(0|7|6|5)[0-9]{7}"
                           class="form-control @error('telephone') is-invalid @enderror">
                    @error('telephone')
                    <div class="invalide-feedBack() text-danger">
                        {{ 'contact déjà inscrit dans la base de données' }}
                    </div>
                    @enderror
                </div>
            </div>

        </div>
    </fieldset>

</div>
