<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\Pool;
use App\Models\Region;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class PoolController extends Controller
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
        $pool = $request->validate([
            'designation'=>'required|unique:App\Models\Pool,designation',
            'regionID'=>'required',
            'abbreviation' => 'required|unique:App\Models\Pool,abbreviation',
        ]);

        Pool::create($pool);

        return redirect()->route('gestParc.indexPools')->with('info', $request->abbreviation.' créé avec succès');

    }


    public function show(Pool $pool)
    {
        $pool->load('vehicules');
        $vehicules = Vehicule::where('idPool', null)->get();

        return view('gestParc/pools/vehiculePool', compact('pool', 'vehicules'));
    }

    public function showChauf(Pool $pool)
    {
        $pool->load('chauffeurs');
        $chauffeurs = Chauffeur::where('idPool', null)->get();

        return view('gestParc/pools/chauffeurPool', compact('pool', 'chauffeurs'));
    }


    public function edit(Pool $pool)
    {
        $regions = Region::all();
        return view('gestParc/pools/editPool', compact('pool', 'regions'));
    }


    public function update(Request $request, Pool $pool)
    {
        $validate = $request->validate([
            'designation'=>'required',
            'regionID'=>'required',
            'abbreviation' => 'required',
        ]);
        $pool->update($validate);
        return redirect()->route('gestParc.indexPools');
    }


    public function destroy(Pool $pool)
    {
        $pool->delete();
        return redirect()->route('gestParc.indexPools');
    }

    public function ajoutVehicule(Request $request, Pool $pool)
    {
        foreach ($request->vehicules as $code)
        {
            $vehicule = Vehicule::find($code);
            $vehicule->idPool = $pool->id;
            $vehicule->save();
        }
        return redirect()->route('pool.show', ['pool' => $pool->id]);
    }

    public function retraitVehicule(Vehicule $vehicule)
    {
        $vehicule->idPool = null;
        $vehicule->save();
        return redirect()->back();
    }

    public function ajoutChauffeur(Request $request, Pool $pool)
    {
        foreach ($request->chauffeurs as $matricule)
        {
            $chauffeur = Chauffeur::find($matricule);
            $chauffeur->idPool = $pool->id;
            $chauffeur->save();
        }
        return redirect()->route('pool.showChauf', ['pool' => $pool->id]);
    }

    public function retraitChauffeur(Chauffeur $chauffeur)
    {
        $chauffeur->idPool = null;
        $chauffeur->save();
        return redirect()->back();
    }
}
