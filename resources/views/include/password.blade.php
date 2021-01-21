
<div>
    <div class="modal fade" id="passwd" tabindex="-1" aria-labelledby="passwd" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{ Auth::user()->login }}
                </div>

                <div class="modal-body">
                    <form class="mt-5" method="post" action="{{route('password.update', ['user' => Auth::user()->id])}}" id="form">
                        @csrf
                        <div class="form-group input-group col-12 row">
                            <label class="col-3">Mot de passe</label>
                            <div class="col-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" value="{{ old('password') }}" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group input-group col-12 row">
                            <label class="col-3">Confirmation</label>
                            <div class="col-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                       required autocomplete="new-password">
                            </div>
                        </div>
                        <button type="submit" id="submitForm" class="btn btn-success m-2">Enregistrer</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <small></small>
                </div>
            </div>
        </div>
    </div>
</div>
