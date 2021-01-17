
@foreach(Auth::user()->roles as $role)
    @if($role->id == 2)
        <a class="dropdown-item text-info" href="{{ route('chefGarage.index') }}">
            {{ __('chef de garage') }}
        </a>
    @endif

    @if($role->id == 3)
        <a class="dropdown-item text-info" href="{{ route('chargeImp.index') }}">
            {{ __('chargé des imputation') }}
        </a>
    @endif

    @if($role->id == 4)
        <a class="dropdown-item text-info" href="{{ route('respPool.attrEnCours') }}">
            {{ __('responsable de pool') }}
        </a>
    @endif

    @if($role->id == 5)
        <a class="dropdown-item text-info" href="{{ route('gestParc.index') }}">
            {{ __('gestionnaire du parc') }}
        </a>
    @endif
