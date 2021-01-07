<?php

namespace App\Http\Controllers;

use App\Models\Attribution;
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

        if ( $filtre['periode'] != 'tous' )
            $interventions = $interventions->where('created_at', $p, $filtre['date']); //->format('Y-m-d')

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
        return view('chefGarage/detailsVehicule', compact('vehicule'));
    }

    public function rechercheVehicule(Request $request)
    {
        $text = $request->text;
        $vehicules = Vehicule::where('code', 'like', '%'.$request->text.'%')
            ->orWhere('modele', 'like', '%'.$request->text.'%')
            ->with('chauffeur')
            ->get();

        return view('chefGarage/vehicule', compact('vehicules', 'text'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
