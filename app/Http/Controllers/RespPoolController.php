<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Attribution;
use App\Models\Chauffeur;
use App\Models\Entite;
use App\Models\Intervention;
use App\Models\Mission;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RespPoolController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $filtre = ['categorie' => '', 'periode' => '', 'date' => null];
        $interventions = Intervention::enCours();
            $interventions->load('vehicule');
            $interventions = $interventions->where('vehicule.idPool', auth()->user()->idPool);

        $absences = Absence::all();

        return view('respPool/respPool', compact('interventions', 'absences', 'filtre'));
    }

    public function requetes()
    {
        $filtre = ['categorie' => '', 'periode' => '', 'date' => null];
        $missions = Mission::doesntHave('attributions')
            ->where('validation', '1')
            ->whereHas('dmdeur', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            })->where(function ($query){
                $query->where('dateRetour', '>', today())
                    ->orWhere('dateRetour', '=', today());
            })->orderBy('created_at', 'DESC')
            ->get();

        return view('respPool/requetes', compact('filtre', 'missions'));
    }

    public function filtreDemande( Request $request )
    {
        $filtre = $request->all();
        $p = $filtre['periode'] == 'avant' ? '<' : ($filtre['periode'] == 'apres' ? '>=' : '=');

        $missions = Mission::doesntHave('attributions')
            ->where('validation', '1')
            ->whereHas('dmdeur', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            })->where(function ($query){
                $query->where('dateRetour', '>', today())
                    ->orWhere('dateRetour', '=', today());
            })->orderBy('created_at', 'DESC')
            ->get();

        if ( $filtre['categorie'] == 'nonTraite' )
            $missions = Mission::doesntHave('attributions')
                ->where('validation', '1')
                ->whereHas('dmdeur', function ($query) {
                    $query->where('idPool', auth()->user()->idPool );
                })->where('dateRetour', '<', today())
                ->orderBy('created_at', 'DESC')
                ->get();

        if ( $filtre['categorie'] == 'traite' )
            $missions = Mission::has('attributions')
                ->whereHas('dmdeur', function ($query) {
                    $query->where('idPool', auth()->user()->idPool );
                })->orderBy('created_at', 'DESC')
                ->get();

        if ( $filtre['periode'] != 'tous' )
            $missions = $missions->where('created_at', $p, $filtre['date']); //->format('Y-m-d')

        return view('respPool/requetes', compact('missions', 'filtre'));
    }

    public function filtreAttribution(Request $request)
    {
        $filtre = $request->all();
        $p = $filtre['periode'] == 'avant' ? '<' : ($filtre['periode'] == 'apres' ? '>=' : '=');

        $attributions = Attribution::whereHas('mission', function ($query) {
            $query->whereHas('dmdeur', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            }); })->get();

        if ( $filtre['categorie'] == 'enCours' )
            $attributions = Attribution::whereHas('mission', function ($query) {
                $query->whereHas('dmdeur', function ($query) {
                    $query->where('idPool', auth()->user()->idPool );
                }); })->where('statut', 1)
                ->orderBy('updated_at', 'DESC')
                ->get();

        if ( $filtre['categorie'] == 'termine' )
            $attributions =Attribution::whereHas('mission', function ($query) {
                $query->whereHas('dmdeur', function ($query) {
                    $query->where('idPool', auth()->user()->idPool );
                }); })->where('statut', 0)
                ->orderBy('created_at', 'DESC')
                ->get();

        if ( $filtre['periode'] != 'tous' )
            $attributions = $attributions->where('updated_at', $p, $filtre['date']); //->format('Y-m-d')

        return view('respPool/attrEnCours', compact('attributions', 'filtre'));
    }

    public function attrEnCours()
    {
        $filtre = ['categorie' => '', 'periode' => '', 'date' => null];
        $attributions = Attribution::whereHas('mission', function ($query) {
            $query->whereHas('dmdeur', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            }); })->where('statut', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('respPool/attrEnCours', compact('attributions', 'filtre'));
    }

    public function detailsRequete( Mission $mission)
    {
        $entites = Entite::all();
        $mission->load('agents:nom,prenom,poste', 'villeDesti', 'villeDep', 'dmdeur');
        $tab = array($mission->dateDepart, $mission->dateRetour);

        Session::put('tab', $tab); //Important pour le scope "selection()"
            //Véhicules dispo avec leur chauffeur
            $vehicules = Vehicule::selection()
                ->whereHas('chauffeur', function ($query) {
                    $query->selection();
                })->get();

            //Véhicules et chauffeur dispo du pool
            $vehicules2 = Vehicule::selection()->get();
            $chauffeurs2 = Chauffeur::selection()->where('idPool', auth()->user()->idPool )->get();

            //Véhicules dispo du pool et chauffeur d'ailleurs
            $vehicules3 = new Vehicule();
            //$chauffeurs3 = Chauffeur::selection()->where('idPool','!=', auth()->user()->idPool )->get();
        Session::forget('tab');

        return view('respPool/detailsRequete', compact('entites','vehicules', 'vehicules2', 'vehicules3', 'mission', 'chauffeurs2'));
    }

    public function historique()
    {
        return view('respPool/historique');
    }

    public function vehicules()
    {
        $vehicules = Vehicule::nbrMiss()->get();
        $vehicules->load('chauffeur');

        return view('respPool/vehiculePool', compact('vehicules'));
    }

    public function rechercheVehicule(Request $request)
    {
        $text = $request->text;
        $vehicules = Vehicule::nbrMiss()
            ->with('chauffeur')
            ->where('code', 'like', '%'.$request->text.'%')
            ->orWhere('modele', 'like', '%'.$request->text.'%')
            ->get();

        return view('respPool/vehiculePool', compact('vehicules', 'text'));
    }

    public function filtreVehicule(Request $request)
    {
        //
    }

    public function chauffeurs()
    {
        $chauffeurs = Chauffeur::nbrMiss()->get();
        $chauffeurs->load('vehicule');

        return view('respPool/chauffeurPool', compact('chauffeurs'));
    }

    public function rechercheChauffeur(Request $request)
    {
        $text = $request->text;
        $chauffeurs = Chauffeur::nbrMiss()
            ->with('vehicule')
            ->where('nom', 'like', '%'.$request->text.'%')
            ->orWhere('prenom', 'like', '%'.$request->text.'%')
            ->orWhere('matricule', 'like', '%'.$request->text.'%')
            ->get();

        return view('respPool/chauffeurPool', compact('chauffeurs', 'text'));
    }

    public function absence()
    {
        $statut = 'enCours';
        $absences = Absence::where('finAbs', '>', Carbon::yesterday())
            ->with('chauffeur')
            ->orderBy('debutAbs', 'DESC')
            ->get();
        $chauffeurs = Chauffeur::all();

        return view('respPool/absencePool', compact('absences', 'chauffeurs', 'statut'));
    }

    public function storeAbsence(Request $request)
    {
        $validate = $request->validate([
            'idChauf'=>'required',
            'debutAbs'=>'required|date',
            'finAbs'=>'required|date|after_or_equal:debutAbs',
            'motif'=>'required'
        ]);
        Absence::create($validate);
        return redirect()->route('respPool.absences');
    }

    public function destroyAbsence(Request $request)
    {
        if ($absence = Absence::find($request->idAbs))
            $absence->delete();
        return redirect()->route('respPool.absences');
    }

    public function filtreAbsence(Request $request)
    {
        $statut = $request->statut;
        $absences = Absence::where('finAbs', '>=', Carbon::yesterday())
            ->with('chauffeur')
            ->orderBy('debutAbs', 'DESC')
            ->get();

        if ( $statut == 'termine' )
            $absences = Absence::where('finAbs', '<', today())
                ->with('chauffeur')
                ->orderBy('debutAbs', 'DESC')
                ->get();

        $chauffeurs = Chauffeur::all();
        return view('respPool/absencePool', compact('absences', 'chauffeurs', 'statut'));
    }
}
