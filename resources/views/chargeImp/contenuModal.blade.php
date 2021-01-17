
    <input type="hidden" placeholder="carburant" name="idAttr" id="caburant" value="{{ $attribution->id }}">

    <div  class="form-group row">
        <label class="col-5" for="">Volume Carburant (L) :</label>
        <div class="col-6">
        <input type="text" placeholder="carburant" name="carburant" id="carburant" required
               value="{{ old('carburant') ?? isset($attribution->ressource->carburant) ? $attribution->ressource->carburant : (old('carburant') ?? '')}}"
               class="form-control @error('carburant') is-invalid @enderror">
        @error('carburant')
        <div class="invalide-feedBack() text-danger">
            Entrez une valeur numerique
        </div>
        @enderror
        </div>
    </div>

    <div  class="form-group row">
        <label class="col-5" for="">Compteur depart (Km) :</label>
        <div class="col-6">
        <input type="text" placeholder="compteur depart" name="comptDepart" id="comptDepart" required
               value="{{  isset($attribution->ressource->comptDepart) ? $attribution->ressource->comptDepart : (old('comptDepart') ?? '')}}"
               class="form-control @error('comptDepart') is-invalid @enderror">
        @error('comptDepart')
        <div class="invalide-feedBack() text-danger">
            Entrez une valeur numerique
        </div>
        @enderror
        </div>
    </div>

    <div  class="form-group row">
        <label class="col-5" for="">Compteur retour (Km) :</label>
        <div class="col-6">
        <input type="text" placeholder="compteur retour" name="comptRetour" id="comptRetour" required
               value="{{ isset($attribution->ressource->comptDepart) ? $attribution->ressource->comptRetour : (old('comptRetour') ?? '')}}"
               class="form-control @error('comptRetour') is-invalid @enderror">
        @error('comptRetour')
        <div class="invalide-feedBack() text-danger">
            Entrez une valeur numerique
        </div>
        @enderror
        </div>
    </div>
