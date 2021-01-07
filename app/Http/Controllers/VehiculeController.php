<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $vehicule = $request->validate([
            'code'=>'required|min:3',
            'immatriculation'=>'required|min:3',
            'modele'=>'required|min:3',
            'acquisition' => 'required|date|before:tomorrow',
        ]);
        Vehicule::create($vehicule);
        return redirect()->route('gestParc.index')->with('info', $request->code.' enregistré avec succès');
    }


    public function show(Vehicule $vehicule)
    {
        $vehicule->load('chauffeur');
        return view('respPool/detailsVehicule', compact('vehicule'));
    }

    public function fullShow(Vehicule $vehicule)
    {
        $vehicule->load('chauffeur');
        $chauffeurs = Chauffeur::doesntHave('vehicule')
            ->where('idPool', $vehicule->idPool)
            ->get();
        return view('gestParc/vehicules/detailsVehicule', compact('vehicule', 'chauffeurs'));
    }


    public function edit(Vehicule $vehicule)
    {
        //
    }


    public function update(Request $request, Vehicule $vehicule)
    {
        //
    }


    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect()->route('gestParc.index')->with('info', $vehicule->code.' supprimé avec succès');
    }

    public function updateChauffeur(Request $request, Vehicule $vehicule)
    {
        $vehicule->idChauf = $request->idChauf;
        $vehicule->save();
        return redirect()->route('vehicule.fullShow', ['vehicule' => $vehicule->code])->with('info', ' Opération réussie');
    }
}
