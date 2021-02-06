@extends('layouts.gestParc')

@section('content')

    <script>
        document.getElementById("documents").style.backgroundColor = "white";
    </script>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Editer infos document de bord</h5>
            </div>

            <div class="modal-body">

                <form class="mt-5" method="post" action="{{route('gestParc.updateDoc', ['doc' => $doc->numero])}}" id="form">

                    @csrf
                    <div class="align-items-center">

                        <fieldset>
                            <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                                <div  class="form-group input-group col-12 row">
                                    <label class="col-3">Code véhicule</label>
                                    <div class="col-9">
                                        <input type="text" name="idVehicule" id="idVehicule" readonly value="{{ old('idVehicule') ?? $doc->idVehicule }}" required placeholder="..." value="{{ old('idVehicule') }}" class="form-control @error('code') is-invalid @enderror">
                                        @error('idVehicule')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'code non reconnu' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div  class="form-group input-group col-12 row">
                                    <label class="col-3">Document</label>
                                    <div class="col-9">
                                        <input type="text" name="type" id="type" readonly required value="{{ $doc->type }}" class="form-control @error('type') is-invalid @enderror">
                                        @error('type')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ ' ' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div  class="form-group input-group col-12 row">
                                    <label class="col-3">Numéro</label>
                                    <div class="col-9">
                                        <input type="text" name="numero" id="numero" value="{{ old('numero') ?? $doc->numero }}" required placeholder="..." value="{{ old('immatriculation') }}" class="form-control @error('immatriculation') is-invalid @enderror">
                                        @error('numero')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'information invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div  class="form-group input-group col-12 row">
                                    <label class="col-3">Date d'établissement</label>
                                    <div class="col-9">
                                        <input type="date" name="etabl" required id="etabl" value="{{ old('etabl') ?? $doc->etabl->format('Y-m-d') }}" class="form-control @error('etabl') is-invalid @enderror">
                                        @error('etabl')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'information invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div  class="form-group input-group col-12 row">
                                    <label class="col-3">Date d'expiration</label>
                                    <div class="col-9">
                                        <input type="date" name="exp" required id="exp" value="{{ old('exp') ?? $doc->exp->format('Y-m-d') }}" class="form-control @error('exp') is-invalid @enderror">
                                        @error('exp')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'information invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div  class="form-group input-group col-12 row">
                                    <label class="col-3">Lieu d'établissement</label>
                                    <div class="col-9">
                                        <input type="text" name="lieu" id="lieu" value="{{ old('lieu') ?? $doc->lieu }}" required placeholder="..." value="{{ old('lieu') }}" class="form-control @error('lieu') is-invalid @enderror">
                                        @error('lieu')
                                        <div class="invalide-feedBack() text-danger">
                                            {{ 'information invalide' }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>

                    <button type="submit" id="submitForm" class="btn btn-success mt-2" >Enregistrer</button>

                </form>

            </div>
        </div>
    </div>

@endsection
