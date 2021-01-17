
<div class="align-items-center">
    <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
        <div class="form-group input-group col-12 row">
            <label class="col-3">Matricule</label>
            <div class="col-9">
                <input type="text" name="matricule" id="matricule"
                       value="{{ old('matricule') ?? $user->matricule }}" required
                       placeholder="..." readonly
                       class="form-control @error('matricule') is-invalid @enderror">
                @error('matricule')
                <div class="invalide-feedBack() text-danger">
                    {{ 'matricule déjà inscrit dans la base de données' }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group input-group col-12 row">
            <label class="col-3">Email</label>
            <div class="col-9">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}"
                       required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group input-group col-12 row">
            <label class="col-3">Pool</label>
            <div class="col-9">
                <select name="idPool" id="idPool" class="form-control" required placeholder="...">
                    <option value=""></option>
                    @foreach($pools as $pool)
                        <option value="{{ $pool->id }}" {{ $pool->id == old('statut') ? 'selected': ($pool->id==$user->idPool ? 'selected':'') }}>{{ $pool->designation }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group input-group col-12 row">
            <label class="col-3">Statut</label>
            <div class="col-9">
                <select name="statut" id="statut" class="form-control" required placeholder="...">
                    <option value=""></option>
                    <option value="1" {{ 1 == old('statut') ? 'selected':( 1==$user->statut ? 'selected':'' ) }}>Actif</option>
                    <option value="0" {{ 0 == old('statut') ? 'selected':( 1==$user->statut ? 'selected':'' ) }}>Bloquer</option>
                </select>
            </div>
        </div>
    </div>
</div>
