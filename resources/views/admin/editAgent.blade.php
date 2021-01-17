@extends('layouts.admin')

@section('content')

    <script>
        document.getElementById("agents").style.backgroundColor = "white";
    </script>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Edition d'un agent</h5>
            </div>

            <div class="modal-body">

                <form class="mt-5" method="post" action="{{route('admin.updateAgent', ['agent' => $agent->matricule])}}" id="form">
                    @method('PATCH')
                    @csrf
                    @include('admin.include.agentForm')
                    <button type="submit" id="submitForm" class="btn btn-success mt-2">Enregistrer</button>
                </form>

            </div>
        </div>
    </div>

@endsection
