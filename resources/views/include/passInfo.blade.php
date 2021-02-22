
@if( session()->get('passError') || $errors->get('passwd') )
    <div class="alert alert-danger mt-3 text-center text-danger alert-dismissible fade show" role="alert">
        Echec de mise à jour du mot de passe
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if( session()->get('passUpdated') )
    <div class="alert alert-success mt-3 text-center text-success alert-dismissible fade show" role="alert">
        {{ session()->get('passUpdated') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
