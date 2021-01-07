
            <table class="table table-success table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Chauffeur</th>
                    <th scope="col">Dernier retour</th>
                    <th scope="col">Mission du mois</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="">
                @foreach( $vehicules as $vehicule )
                    <tr>
                        <td>{{ $vehicule->code }}</td>
                        <td>{{ $vehicule->modele }}</td>
                        <td>
                            @isset($vehicule->chauffeur->nom)
                                {{ $vehicule->chauffeur->nom }} {{ $vehicule->chauffeur->prenom }}
                            @endisset</td>
                        <td>{{ isset($vehicule->dernierRetour) ? $vehicule->dernierRetour->format('d/m/Y'):'' }}</td>
                        <td>{{ $vehicule->attributions_count }}</td>
                        <td>
                            <a href="{{route('vehicule.show', ['vehicule' => $vehicule->code])}}">
                                <button class="btn btn-info p-1">
                                    detail
                                </button>
                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
