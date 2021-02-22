
<div class="align-items-center">
    <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">
        <div class="form-group input-group col-12 row">
            <label class="col-3">Matricule</label>
            <div class="col-9">
                <select name="matricule" id="matricule" class="form-control" readonly="true" required placeholder="...">
                    <option value="{{ $user->agent->matricule }}" selected>{{ $user->agent->nom }} {{ $user->agent->prenom }}</option>
                    {{-- @foreach($agents as $ag)
                        <option value="{{ $ag->matricule }}" {{ $ag->matricule == old('matricule') ? 'selected': ($ag->matricule==$user->agent->matricule ? 'selected':'') }}>
                            {{ $ag->nom }} {{ $ag->prenom }}
                        </option>
                    @endforeach --}}
                </select>
                @error('matricule')
                <div class="invalide-feedBack() text-danger">
                    {{ 'matricule déjà inscrit dans la base de données' }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group input-group col-12 row">
            <label class="col-3">Login</label>
            <div class="col-9">
                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') ?? $user->login }}"
                       required autocomplete="login">
                @error('login')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group input-group col-12 row">
            <label class="col-3">Statut</label>
            <div class="col-9">
                <select name="statut" id="statut" class="form-control" required placeholder="...">
                    <option value=""></option>
                    <option value="1" {{ old('statut')=='1' ? 'selected':( $user->statut=='actif' ? 'selected':'' ) }}>Actif</option>
                    <option value="0" {{ old('statut')=='0' ? 'selected':( $user->statut=='inactif' ? 'selected':'' ) }}>Bloqué</option>
                </select>
            </div>
        </div>
    </div>
</div>
