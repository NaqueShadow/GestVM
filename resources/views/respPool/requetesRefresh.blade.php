
@foreach($missions as $mission)
    <tr>
        <td> {{$mission->updated_at->format('d/m/Y')}} </td>
        <td> {{$mission->dmdeur->agent->nom}} {{$mission->dmdeur->agent->prenom}} </td>
        <td> {{strlen($mission->objet) < 26 ?$mission->objet:substr($mission->objet,0,25).'...'}} </td>
        <td> {{$mission->villeDesti->nom}} </td>
        <td> {{$mission->dateDepart->format('d/m/Y')}} </td>
        <td> {{$mission->dateRetour->format('d/m/Y')}} </td>
        <td>
            <div class="dropdown">
                <button title="exporter" class="btn btn-link text-primary pt-0 pb-0 dropdown-toggle" data-toggle="dropdown" >
                </button>
                <div class="dropdown-menu dropdown-menu-sm-right">
                    <a href="/attribution/{{ $mission->id }}" class="dropdown-item">
                        <button class="btn btn-link text-info" title="traiter la requête">
                            Ouvrir
                        </button>
                    </a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
