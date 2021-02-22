<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Entite;
use App\Models\Pool;
use App\Models\Ressource;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class StatController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->mois)) {
            $mois = $request->mois;
            $annee = $request->annee;
            $a = Date::create($annee, $mois)->firstOfMonth();
            $b = Date::create($annee, $mois)->lastOfMonth(); //dd($a, $b);
        }
        else {
            $mois = today()->format('m');
            $annee = today()->format('Y');
            $a = Date::now()->firstOfMonth();
            $b = Date::now()->lastOfMonth();
        }

        $entites = Entite::whereHas('missions', function ($query) use($a, $b) {
            $query->whereBetween('dateDepart', [$a, $b]);
        })->get();
        $entite = 0;

        $tab1[] = null;
        $tab2[] = null;
        $tab3[] = null;
        foreach ($entites as $ent) {
                $ressources = Ressource::select('comptRetour', 'comptDepart', 'carburant')
                    ->whereHas('attributions', function ($query) use ($a, $b, $ent) {
                        $query->whereHas('mission', function ($query) use ($a, $b, $ent) {
                            $query->whereBetween('dateDepart', [$a, $b])
                                ->where('idEntite', $ent->id);
                        });
                    })->get();

                $dist = 0;
                $carb = 0;
                foreach ($ressources as $ressource) {
                    if (!empty($ressource->comptDepart))
                        $dist += ($ressource->comptRetour - $ressource->comptDepart);
                    if (!empty($ressource->carburant))
                        $carb += $ressource->carburant;
                }

                $tab1[] = $ent->designation;
                $tab2[] = $dist;
                $tab3[] = $carb;
            }

        return view('gestParc.statistiques.index', compact('tab1', 'tab2', 'tab3', 'entite', 'entites', 'mois', 'annee'));
    }

    public function filtre(Request $request)
    {
        $mois = $request->mois;
        $annee = $request->annee;
        $a = Date::create($annee, $mois)->firstOfMonth();
        $b = Date::create($annee, $mois)->lastOfMonth();

        $entite = $request->entite;
        $entites = Entite::all()->load('attributions', 'attributions.ressource');

        $vehicules = Vehicule::whereHas('attributions', function ($query) use($a, $b, $entite) {
            $query->whereHas('mission', function ($query) use($a, $b, $entite) {
                $query->whereBetween('dateDepart', [$a, $b]);
            })->where('idEntite', $entite);
        });

        $tab1[] = null;
        $tab2[] = null;
        $tab3[] = null;
        foreach ($vehicules as $vehicule) {
            $ressources = Ressource::select('comptRetour', 'comptDepart', 'carburant')
                ->whereHas('attributions', function ($query) use($a, $b, $entite, $vehicule) {
                    $query->where('idEntite', $entite->id)
                        ->where('idVehicule', $vehicule->code)
                        ->whereHas('mission', function ($query) use($a, $b) {
                            $query->whereBetween('dateDepart', [$a, $b]);
                        });
                })->get();

            $dist = 0;
            $carb = 0;
            foreach ($ressources as $ressource) {
                if (!empty($ressource->comptDepart))
                    $dist += ($ressource->comptRetour - $ressource->comptDepart);
                if (!empty($ressource->carburant))
                    $carb += $ressource->carburant;
            }

            $tab1[] = $vehicule->code;  dd($tab1);
            $tab2[] = $dist;
            $tab3[] = $carb;
        }

        return view('gestParc.statistiques.index', compact('tab1', 'tab2', 'tab3', 'entite', 'entites', 'mois', 'annee'));
    }


    public function indexPool(Request $request)
    {
        if (isset($request->mois)) {
            $mois = $request->mois;
            $annee = $request->annee;
            $a = Date::create($annee, $mois)->firstOfMonth();
            $b = Date::create($annee, $mois)->lastOfMonth(); //dd($a, $b);
        }
        else {
            $mois = today()->format('m');
            $annee = today()->format('Y');
            $a = Date::now()->firstOfMonth();
            $b = Date::now()->lastOfMonth();
        }
        $pools = Pool::all();

        $tab1[] = null;
        $tab2[] = null;
        $tab3[] = null;
        foreach ($pools as $pool) {
            $ressources = Ressource::select('comptRetour', 'comptDepart', 'carburant')
                ->whereHas('attributions', function ($query) use($a, $b, $pool) {
                    $query->whereHas('mission', function ($query) use($a, $b) {
                            $query->whereBetween('dateDepart', [$a, $b]);
                        })->whereHas('vehicule', function ($query) use($pool) {
                            $query->where('idPool', $pool->id);
                        });
                })->get();

            $dist = 0;
            $carb = 0;
            foreach ($ressources as $ressource) {
                if (!empty($ressource->comptDepart))
                    $dist += ($ressource->comptRetour - $ressource->comptDepart);
                if (!empty($ressource->carburant))
                    $carb += $ressource->carburant;
            }
            $tab1[] = $pool->designation;
            $tab2[] = $dist;
            $tab3[] = $carb;
        }
        //dd($tab1, $tab2, $tab3);

        return view('gestParc.statistiques.indexPools', compact('tab1', 'tab2', 'tab3', 'mois', 'annee'));
    }


    public function indexVehicule(Request $request)
    {
        if (isset($request->mois)) {
            $mois = $request->mois;
            $annee = $request->annee;
            $a = Date::create($annee, $mois)->firstOfMonth();
            $b = Date::create($annee, $mois)->lastOfMonth(); //dd($a, $b);
        }
        else {
            $mois = today()->format('m');
            $annee = today()->format('Y');
            $a = Date::now()->firstOfMonth();
            $b = Date::now()->lastOfMonth();
        }

        $vehicules = Vehicule::whereHas('attributions', function ($query) use($a, $b) {
            $query->whereHas('mission', function ($query) use($a, $b) {
                $query->whereBetween('dateDepart', [$a, $b]);
            });
        })->get();

        $tab1[] = null;
        $tab2[] = null;
        $tab3[] = null;
        $tab4[] = null;
        foreach ($vehicules as $vehicule) {
            $ressources = Ressource::select('comptRetour', 'comptDepart', 'carburant')
                ->whereHas('attributions', function ($query) use($a, $b, $vehicule) {
                    $query->where('idVehicule', $vehicule->code)
                        ->whereHas('mission', function ($query) use($a, $b) {
                            $query->whereBetween('dateDepart', [$a, $b]);
                        });
                })->get();

            $dist = 0;
            $carb = 0;
            foreach ($ressources as $ressource) {
                if (!empty($ressource->comptDepart))
                    $dist += ($ressource->comptRetour - $ressource->comptDepart);
                if (!empty($ressource->carburant))
                    $carb += $ressource->carburant;
            }

            $tab1[] = $vehicule->code;
            $tab2[] = $dist;
            $tab3[] = $carb;
            if ($carb == 0) $carb=1;
            $tab4[] = $dist/$carb;
        }

        return view('gestParc.statistiques.indexVehicules', compact('tab1', 'tab2', 'tab3', 'tab4', 'mois', 'annee'));
    }


    public function indexActivite(Request $request)
    {
        if (isset($request->mois)) {
            $mois = $request->mois;
            $annee = $request->annee;
            $a = Date::create($annee, $mois)->firstOfMonth();
            $b = Date::create($annee, $mois)->lastOfMonth(); //dd($a, $b);
        }
        else {
            $mois = today()->format('m');
            $annee = today()->format('Y');
            $a = Date::now()->firstOfMonth();
            $b = Date::now()->lastOfMonth();
        }

        $activites = Activite::all();
        $activite = 0;

        $tab1[] = null;
        $tab2[] = null;
        $tab3[] = null;
        foreach ($activites as $act) {
            $ressources = Ressource::select('comptRetour', 'comptDepart', 'carburant')
                ->whereHas('attributions', function ($query) use ($a, $b, $act) {
                    $query->whereHas('mission', function ($query) use ($a, $b, $act) {
                        $query->whereBetween('dateDepart', [$a, $b])
                            ->where('idActivite', $act->code);
                    });
                })->get();

            $dist = 0;
            $carb = 0;
            foreach ($ressources as $ressource) {
                if (!empty($ressource->comptDepart))
                    $dist += ($ressource->comptRetour - $ressource->comptDepart);
                if (!empty($ressource->carburant))
                    $carb += $ressource->carburant;
            }

            $tab1[] = $act->designation;
            $tab2[] = $dist;
            $tab3[] = $carb;
        }

        return view('gestParc.statistiques.indexActivites', compact('tab1', 'tab2', 'tab3', 'activite', 'activites', 'mois', 'annee'));
    }
}
