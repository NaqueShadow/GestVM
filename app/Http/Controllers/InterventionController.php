<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class InterventionController extends Controller
{

    public function index()
    {
        $interventions = Intervention::all();

        return view('chefGarage/historique', compact('interventions'));
    }

    public function create() {  }

    public function store(Request $request)
    {
        $validate = $request->validate([

            'idVehicule'=>'required|min:3',
            'debut'=>'required|date',
            'finPrev'=>'required|date|after_or_equal:debut',
            'type'=>'required'
        ]);
        Intervention::create($validate);

        return back();
    }


    public function show($id) {  }

    public function edit($id)
    {
        return route('chefGarage.index');
    }

    public function terminerInt(Intervention $intervention)
    {
        $intervention->statut = 0;
        $intervention->save();

        return back();
    }

    public function update(Request $request, $id) {  }


    public function destroy( Intervention $intervention )
    {
        $intervention->delete();
        return back();
    }
}
