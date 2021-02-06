@extends('layouts.chefGarage')

@section('content')

    <script>
        document.getElementById("intervention").style.backgroundColor = "white";
    </script>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Editer infos intervention</h5>
            </div>

            <div class="modal-body">

                <form class="mt-5" method="post" action="{{route('intervention.update', ['intervention' => $intervention->id])}}" id="form">

                    @csrf
                    <div class="align-items-center">

                        <div class="form-row" style="padding: 2%; margin-bottom: auto; border: 1px solid mediumseagreen; border-radius: 15px;">

                            <div class="col-3"></div>
                            <div  class="form-group col-6">

                                <div class="">
                                    <select name="idVehicule" required id="idVehicule" class="w-100 selectpicker @error('idVehicule') is-invalid @enderror" @include('include.selectOption')>
                                        <option value=""></option>
                                        @foreach($vehicules as $vehicule)
                                            <option value="{{ $vehicule->code }}" {{$vehicule->code==old('idVehicule') ? 'selected':($intervention->idVehicule==$vehicule->code?'selected':'')}}>{{ $vehicule->code }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('idVehicule')
                                <div class="invalide-feedBack()">
                                    {{ $errors->first('idVehicule') }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-3"></div>

                            <div  class="form-group col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Début</div>
                                    </div>
                                    <input type="date" name="debut" required id="debut" value="{{ old('debut') ?? $intervention->debut->format('Y-m-d') }}" class="form-control @error('debut') is-invalid @enderror">
                                </div>
                                @error('debut')
                                <div class="invalide-feedBack() text-danger">
                                    date invalide
                                </div>
                                @enderror
                            </div>

                            <div  class="form-group col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Fin</div>
                                    </div>
                                    <input type="date" name="finPrev" required id="finPrev" value="{{ old('finPrev') ?? $intervention->finPrev->format('Y-m-d') }}" class="form-control @error('finPrev') is-invalid @enderror">
                                </div>
                                @error('finPrev')
                                <div class="invalide-feedBack() text-danger">
                                    date invalide
                                </div>
                                @enderror
                            </div>

                            <div class="col-3"></div>
                            <div  class="form-group col-6">

                                <select name="type" required id="type" class="custom-select @error('type') is-invalid @enderror">
                                    <option value="">selectionner le motif</option>
                                    <option value="preventive" {{'preventive' == old('type') ? 'selected':($intervention->type=='preventive'?'selected':'')}}>Maintenance préventive</option>
                                    <option value="curative" {{'curative' == old('type') ? 'selected':($intervention->type=='curative'?'selected':'')}}>Maintenance curative</option>
                                </select>
                                @error('type')
                                <div class="invalide-feedBack() text-danger">
                                    {{ 'invalide' }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-3"></div>

                        </div>

                    </div>

                    <button type="submit" id="submitForm" class="btn btn-success mt-2" >Enregistrer</button>

                </form>

            </div>
        </div>
    </div>

@endsection
