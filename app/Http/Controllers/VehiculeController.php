<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\DocBord;
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
        $doc1 = DocBord::where('idVehicule', $vehicule->code)->where('type', 1)->orderBy('etabl','DESC')->first();
        $doc2 = DocBord::where('idVehicule', $vehicule->code)->where('type', 2)->orderBy('etabl','DESC')->first();
        $doc3 = DocBord::where('idVehicule', $vehicule->code)->where('type', 3)->orderBy('etabl','DESC')->first();
        return view('respPool/detailsVehicule', compact('vehicule', 'doc1', 'doc2', 'doc3'));
    }

    public function fullShow(Vehicule $vehicule)
    {
        $vehicule->load('chauffeur');
        $doc1 = DocBord::where('idVehicule', $vehicule->code)->where('type', 1)->orderBy('etabl','DESC')->first();
        $doc2 = DocBord::where('idVehicule', $vehicule->code)->where('type', 2)->orderBy('etabl','DESC')->first();
        $doc3 = DocBord::where('idVehicule', $vehicule->code)->where('type', 3)->orderBy('etabl','DESC')->first();
        $chauffeurs = Chauffeur::doesntHave('vehicule')
            ->where('idPool', $vehicule->idPool)
            ->get();
        return view('gestParc/vehicules/detailsVehicule', compact('vehicule', 'chauffeurs', 'doc1', 'doc2', 'doc3'));
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
