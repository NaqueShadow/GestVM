<?php

namespace App\Http\Controllers;

use App\Models\Attribution;
use App\Models\DocBord;
use App\Models\Intervention;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class ChefGarageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $filtre = ['categorie' => '', 'periode' => '', 'date' => null];
        $vehicules = Vehicule::all();
        $interventions = Intervention::enCours()
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('chefGarage/chefGarage', compact('interventions', 'vehicules', 'filtre'));
    }

    public function filtreIntervention(Request $request)
    {
        $filtre = $request->all();
        $vehicules = Vehicule::all();
        $p = $filtre['periode'] == 'avant' ? '<' : ($filtre['periode'] == 'apres' ? '>=' : '=');

        $interventions = Intervention::enCours()->get();

        if ( $filtre['categorie'] == 'enCours' )
            $interventions = Intervention::enCours()
                ->orderBy('created_at', 'DESC')
                ->get();

        if ( $filtre['categorie'] == 'termine' )
            $interventions =Intervention::where('statut', 0)
                ->orderBy('created_at', 'DESC')
                ->get();

        if ( $filtre['periode'] == 'avant' )
            $interventions = $interventions->where('created_at', '<', $filtre['date']); //->format('Y-m-d')
        if ( $filtre['periode'] == 'apres' )
            $interventions = $interventions->where('created_at', '>', $filtre['date']); //->format('Y-m-d')
        if ( $filtre['periode'] == 'le' )
            $interventions = $interventions->where('created_at', $filtre['date']); //->format('Y-m-d')

        return view('chefGarage/chefGarage', compact('interventions', 'vehicules', 'filtre'));
    }

    public function listeVehicules()
    {
        $vehicules = Vehicule::all();
        $vehicules->load('chauffeur');

        return view('chefGarage/vehicule', compact('vehicules'));
    }

    public function voirVehicule(Vehicule $vehicule)
    {
        $vehicule->load('chauffeur');
        $doc1 = DocBord::where('idVehicule', $vehicule->code)->where('type', 1)->orderBy('etabl','DESC')->first();
        $doc2 = DocBord::where('idVehicule', $vehicule->code)->where('type', 2)->orderBy('etabl','DESC')->first();
        $doc3 = DocBord::where('idVehicule', $vehicule->code)->where('type', 3)->orderBy('etabl','DESC')->first();

        return view('chefGarage/detailsVehicule', compact('vehicule', 'doc1', 'doc2', 'doc3'));
    }

    public function rechercheVehicule(Request $request)
    {
        $text = $request->text;
        $vehicules = Vehicule::where('code', 'like', '%'.$request->text.'%')
            ->orWhere('modele', 'like', '%'.$request->text.'%')
            ->orWhereHas('chauffeur', function ($query) use($request) {
                $query->where('nom', 'like', '%'.$request->text.'%')
                    ->orWhere('prenom', 'like', '%'.$request->text.'%');
            })
            ->with('chauffeur')
            ->get();

        return view('chefGarage/vehicule', compact('vehicules', 'text'));
    }

}
