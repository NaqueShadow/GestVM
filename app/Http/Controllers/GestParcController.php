<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\Pool;

class GestParcController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vehicules = Vehicule::all();
        $vehicule = new Vehicule();

        return view('gestParc/vehicules/index', compact('vehicules', 'vehicule'));
    }

    public function rechercheVehicule(Request $request)
    {
        $text = $request->text;
        $vehicules = Vehicule::nbrMiss()
            ->with('chauffeur')
            ->where('code', 'like', '%'.$request->text.'%')
            ->orWhere('modele', 'like', '%'.$request->text.'%')
            ->get();

        return view('gestParc/vehicules/index', compact('vehicules', 'text'));
    }

    public function indexChauffeurs()
    {
        $chauffeurs = Chauffeur::all();
        $chauf = new Chauffeur();
        $vehicules = Vehicule::doesnthave('chauffeur')->get();
        return view('gestParc/chauffeurs/index', compact('chauffeurs', 'chauf', 'vehicules'));
    }

    public function rechercheChauffeur(Request $request)
    {
        $text = $request->text;
        $chauffeurs = Chauffeur::nbrMiss()
            ->where('nom', 'like', '%'.$request->text.'%')
            ->orWhere('prenom', 'like', '%'.$request->text.'%')
            ->orWhere('matricule', 'like', '%'.$request->text.'%')
            ->get();

        return view('gestParc/chauffeurs/index', compact('chauffeurs', 'text'));
    }

    public function indexPools()
    {
        $pools = Pool::withCount('vehicules', 'chauffeurs')->get();
        $pool = new Pool();
        $regions = Region::all();
        return view('gestParc/pools/index', compact('pools', 'pool', 'regions'));
    }

    public function recherchePool(Request $request)
    {
        $text = $request->text;
        $pools = Pool::where('designation', 'like', '%'.$request->text.'%')
            ->orWhere('abbreviation', 'like', '%'.$request->text.'%')
            ->get();

        return view('gestParc/pools/index', compact('chauffeurs', 'text'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
