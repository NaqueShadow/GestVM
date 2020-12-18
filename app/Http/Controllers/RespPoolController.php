<?php

namespace App\Http\Controllers;

use App\Models\Attribution;
use App\Models\Chauffeur;
use App\Models\Intervention;
use App\Models\Mission;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Jenssegers\Date\Date;

class RespPoolController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $interventions = Intervention::enCours();
            $interventions->load('vehicule');
            $interventions = $interventions->where('vehicule.idPool', auth()->user()->idPool);

        $attributions = Attribution::enCours();

        return view('respPool/respPool', compact('interventions', 'attributions'));
    }

    public function requetes()
    {
        $attributions = Attribution::enCours();
        $missions = Mission::doesntHave('attribution')
            ->whereHas('dmdeur', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            })
            ->get();

        return view('respPool/requetes', compact('attributions', 'missions'));
    }

    public function detailsRequete( Mission $mission)
    {
        $mission->load('agents:nom,prenom,poste', 'villeDesti', 'villeDep', 'dmdeur');
        $tab = array($mission->dateDepart, $mission->dateRetour);
        Session::put('tab', $tab);

        $vehicules = Vehicule::where('idPool', auth()->user()->idPool )
            ->whereDoesntHave('interventions', function ($query) {
                $query->whereBetween('debut', session('tab' ))
                    ->whereBetween('finPrev', session('tab' ));
            })
            ->whereDoesntHave('attributions', function ($query) {
                $query->whereHas('mission', function ($query) {
                    $query->whereBetween('dateDepart', session('tab' ))
                        ->whereBetween('dateRetour', session('tab' ));
                });
            })
            ->get();

        Session::forget('tab');

        return view('respPool/detailsRequete', compact('vehicules', 'mission'));
    }

    public function historique()
    {

        return view('respPool/historique');
    }

    public function vehicules()
    {
        $vehicules = Vehicule::nbrMiss();
        $vehicules->load('chauffeur');

        return view('respPool/vehiculePool', compact('vehicules'));
    }

    public function chauffeurs()
    {
        $chauffeurs = Chauffeur::nbrMiss();
        $chauffeurs->load('vehicule');

        return view('respPool/chauffeurPool', compact('chauffeurs'));
    }

    //===================================

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
