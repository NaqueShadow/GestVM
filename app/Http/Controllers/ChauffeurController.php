<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class ChauffeurController extends Controller
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
        $chauffeur = $request->validate([
            'matricule'=>'required|numeric|unique:App\Models\Chauffeur,matricule',
            'nom'=>'required|min:2',
            'prenom'=>'required|min:2',
            'telephone' => 'required|min:8|numeric|unique:App\Models\Chauffeur,telephone',
        ]);

        Chauffeur::create($chauffeur);

        return redirect()->route('gestParc.indexChauffeurs')->with('info', $request->nom.' '.$request->prenom.' enregistré avec succès');
    }


    public function show(Chauffeur $chauffeur)
    {
        $chauffeur->load('vehicule');
        return view('respPool/detailsChauffeur', compact('chauffeur'));
    }

    public function fullShow(Chauffeur $chauffeur)
    {
        $chauffeur->load('vehicule');
        return view('gestParc/chauffeurs/detailsChauffeur', compact('chauffeur'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();
        return redirect()->route('gestParc.indexChauffeurs')->with('info', $chauffeur->nom.' '.$chauffeur->prenom.' supprimé avec succès');
    }
}
