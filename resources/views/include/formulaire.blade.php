
	@csrf
	<div  class="form-group">
		<input type="text" name="nom" placeholder="Entrez un nom" value="{{ old('nom') ?? $client->nom }}" class="form-control @error('nom') is-invalid @enderror">
		@error('nom')
			<div class="invalide-feedBack()">
				{{ $errors->first('nom') }}
			</div>
		@enderror
	</div>
	<div  class="form-group">
		<input type="text" name="email" placeholder="Entrez un email" value="{{ old('email') ?? $client->email }}" class="form-control @error('email') is-invalid @enderror">
		@error('email')
			<div class="invalide-feedBack()">
				{{ $errors->first('email') }}
			</div>
		@enderror
	</div>
	<div  class="form-group">
		<div class="">
			<select name="status" value="{{ old('status') ?? $client->status }}" class="custom-select @error('status') is-invalid @enderror">
				<option value="">Choose...</option>
				<option value="1">Actif</option>
				<option value="0">Inactif</option>
			</select>
		</div>
		@error('status')
			<div class="invalide-feedBack()">
				{{ $errors->first('status') }}
			</div>
		@enderror
	</div>
	<div  class="form-group">
		<div class="">
			<select name="entreprise_id" class="custom-select @error('entreprise_id') is-invalid @enderror">
				@foreach($entreprises as $entreprise)
				<option value="{{$entreprise->id}}">{{$entreprise->nom}}</option>
				@endforeach
			</select>
		</div>
		@error('entreprise_id')
			<div class="invalide-feedBack()">
				{{ $errors->first('entreprise_id') }}
			</div>
		@enderror
	</div>