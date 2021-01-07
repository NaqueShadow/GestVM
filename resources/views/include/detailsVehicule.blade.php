
        <div class="card-body row" style="color: #284563;">
            <div class="col-6 pl-5">
                <table class="table table-responsive">
                    <tr>
                        <th>code véhicule</th> <td class="text-info h5">     {{$vehicule->code}}</td>
                    </tr>
                    <tr>
                        <th>Modele</th> <td class="text-info h5">     {{$vehicule->modele}}</td>
                    </tr>
                    <tr>
                        <th>Immaticulation</th> <td class="text-info h5">   {{$vehicule->immatriculation}}</td>
                    </tr>
                </table>
            </div>

            <div class="col-6 pl-5">
                @if( isset($vehicule->chauffeur->nom) )
                    <table class="table table-responsive">
                        <tr>
                            <th>Chauffeur</th> <td class="text-info h5">:   {{$vehicule->chauffeur->nom}} {{$vehicule->chauffeur->prenom}}</td>
                        </tr>
                        <tr>
                            <th>Matricule</th> <td class="text-info h5">:   {{$attribution->idChauf}}</td>
                        </tr>
                        <tr>
                            <th>Contact</th> <td class="text-info h5">:   {{$attribution->chauffeur->telephone}}</td>
                        </tr>
                    </table>
                @else
                    <div class="text-dark mt-5">Véhicule sans chauffeur affecté</div>
                @endif
            </div>

            <div class="col-6 pl-5 " style="margin-left: 25%;">
                <table class="table table-responsive">
                    <tr>
                        <td></td> <td class="">code</td> <td class="">établit le</td> <td class="">expire le</td>
                    </tr>
                    <tr>
                        <th class="t">Visite technique</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                    <tr>
                        <th>Assurance</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                    <tr>
                        <th>Carte grise</th>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                        <td class="text-dark h5">{{$vehicule->modele}}</td>
                    </tr>
                </table>
            </div>
        </div>
