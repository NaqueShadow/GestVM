
@foreach(Auth::user()->roles as $role)
    @if($role->id == 7)
        <a class="dropdown-item text-info" href="{{ route('valideur.index') }}">
            {{ __('Valideur') }}
        </a>
    @endif

    @if($role->id == 2)
        <a class="dropdown-item text-info" href="{{ route('chefGarage.index') }}">
            {{ __('Chargé des interventions') }}
        </a>
    @endif

    @if($role->id == 3)
        <a class="dropdown-item text-info" href="{{ route('chargeImp.index') }}">
            {{ __('Chargé des imputations') }}
        </a>
    @endif

    @if($role->id == 4)
        <a class="dropdown-item text-info" href="{{ route('respPool.attrEnCours') }}">
            {{ __('Responsable de pool') }}
        </a>
    @endif

    @if($role->id == 5)
        <a class="dropdown-item text-info" href="{{ route('gestParc.index') }}">
            {{ __('Gestionnaire du parc') }}
        </a>
    @endif

    @if($role->id == 6)
        <a class="dropdown-item text-info" href="{{ route('admin.index') }}">
            {{ __('Administrateur') }}
        </a>
    @endif
@endforeach
