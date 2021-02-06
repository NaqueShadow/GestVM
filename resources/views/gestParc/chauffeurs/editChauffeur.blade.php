@extends('layouts.admin')

@section('content')

    <script>
        document.getElementById("chauffeurs").style.backgroundColor = "white";
    </script>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Editer infos chauffeur</h5>
            </div>

            <div class="modal-body">

                <form class="mt-5" method="post" action="{{ route('chauffeur.update', ['chauffeur' => $chauffeur->matricule]) }}" id="form">

                    @csrf
                    <div class="align-items-center">
                        <fieldset>
                            <div class="form-row"
                                 style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                                <div class="form-group input-group col-12 row">
                                    <label class="col-3">Matricule</label>
                                    <div class="col-9">
                                        <input type="text" name="matricule" id="matricule"
                                               value="{{ old('matricule') ?? $chauffeur->matricule }}" required
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
                                               value="{{ old('nom') ?? $chauffeur->nom }}"
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
                                               value="{{ old('prenom') ?? $chauffeur->prenom }}" required
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
                                    <label class="col-3">Contact</label>
                                    <div class="col-9">
                                        <small class="text-info">* huit chiffres</small>
                                        <input type="tel" name="telephone" id="telephone"
                                               value="{{ old('telephone') ?? $chauffeur->telephone }}" required
                                               placeholder="..."
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

                    <button type="submit" id="submitForm2" class="btn btn-success mt-2">Enregistrer</button>

                </form>

            </div>
        </div>
    </div>

@endsection
