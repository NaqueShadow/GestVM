<?php

namespace App\Http\Controllers;

use App\Imports\ChauffeurImport;
use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class ChauffeurController extends Controller
{
    public function store(Request $request)
    {
        if ($request->form == 1)
        {
            $chauffeur = $request->validate([
                'matricule'=>'required|numeric|unique:App\Models\Chauffeur,matricule',
                'nom'=>'required|min:2',
                'prenom'=>'required|min:2',
                'telephone' => 'required|min:8|numeric|unique:App\Models\Chauffeur,telephone',
            ]);
            Chauffeur::create($chauffeur);
        }
        elseif ($request->form == 2)
        {
            (new ChauffeurImport())->import($request->file('fichier')->path(), null, \Maatwebsite\Excel\Excel::XLSX);
        }

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


    public function edit(Chauffeur $chauffeur)
    {
        return view('gestParc/chauffeurs/editChauffeur', compact('chauffeur'));
    }


    public function update(Request $request, Chauffeur $chauffeur)
    {
        $validate = $request->validate([
            'matricule'=>'required|numeric',
            'nom'=>'required|min:2',
            'prenom'=>'required|min:2',
            'telephone' => 'required|min:8|numeric',
        ]);

        $chauffeur->update($validate);
        return redirect()->route('gestParc.indexChauffeurs');
    }


    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();
        return redirect()->route('gestParc.indexChauffeurs')->with('info', $chauffeur->nom.' '.$chauffeur->prenom.' supprimé avec succès');
    }
}
