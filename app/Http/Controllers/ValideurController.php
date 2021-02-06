<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use App\Models\Mission;
use Illuminate\Http\Request;

class ValideurController extends Controller
{

    public function index()
    {
        $filtre = ['categorie' => '', 'periode' => '', 'date' => null];
        $missions = Mission::where('validation', 0)
            ->where('idValideur', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('valideur/demandes', compact('filtre', 'missions'));
    }

    public function filtreDemande( Request $request )
    {
        $filtre = $request->all();
        $p = $filtre['periode'] == 'avant' ? '<' : ($filtre['periode'] == 'apres' ? '>=' : '=');

        $missions = Mission::where('validation', '0')
            ->where('idValideur', auth()->user()->id)
            ->where('dateRetour', '>', today())
            ->orWhere('dateRetour', '=', today())
            ->orderBy('created_at', 'DESC')
            ->get();

        if ( $filtre['categorie'] == 'nonTraite' )
            $missions = Mission::where('validation', '0')
                ->where('idValideur', auth()->user()->id)
                ->where('dateRetour', '<', today())
                ->orderBy('created_at', 'DESC')
                ->get();
        if ( $filtre['categorie'] == 'traite' )
            $missions = Mission::where('validation', '!=', '0')
                ->where('idValideur', auth()->user()->id)
                ->orderBy('created_at', 'DESC')
                ->get();

        if ( $filtre['periode'] != 'tous' )
            $missions = $missions->where('created_at', $p, $filtre['date']); //->format('Y-m-d')

        return view('valideur/demandes', compact('missions', 'filtre'));
    }


    public function indexValidation()
    {
        $filtre = ['categorie' => '', 'periode' => '', 'date' => null];
        $missions = Mission::whereHas('dmdeur', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            })->where('validation', '!=', '0')
            ->where('idValideur', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('valideur/validations', compact('filtre', 'missions'));
    }

    public function filtreValidation(Request $request)
    {
        $filtre = $request->all();
        $p = $filtre['periode'] == 'avant' ? '<' : ($filtre['periode'] == 'apres' ? '>=' : '=');
        $missions = Mission::where('validation', '!=', '0')
            ->where('idValideur', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        if ( $filtre['categorie'] == 'valide' )
            $missions = Mission::where('validation', '1')
                ->where('idValideur', auth()->user()->id)
                ->orderBy('created_at', 'DESC')
                ->get();

        if ( $filtre['categorie'] == 'invalide' )
            $missions = Mission::where('validation', '2')
                ->where('idValideur', auth()->user()->id)
                ->orderBy('created_at', 'DESC')
                ->get();

        if ( $filtre['periode'] != 'tous' )
            $missions = $missions->where('created_at', $p, $filtre['date']); //->format('Y-m-d')

        return view('valideur/validations', compact('missions', 'filtre'));
    }


    public function showMission( Mission $mission)
    {
        $entites = Entite::all();
        $mission->load('agents:nom,prenom,poste', 'villeDesti', 'villeDep', 'dmdeur');

        return view('valideur/detailsDemande', compact('entites','mission'));
    }

    public function valider(Request $request, Mission $mission)   {
        if ($request->validation == 'valide') {
            $mission->validation = 1;
            $mission->save();
        }
        if ($request->validation == 'invalide') {
            $mission->validation = -1;
            $mission->save();
        }
        return redirect()->route('valideur.index');
    }

    public function destroy($id)
    {
        //
    }
}
