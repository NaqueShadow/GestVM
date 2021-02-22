<?php

namespace App\Http\Controllers;

use App\Events\Validation_event;
use App\Models\Activite;
use App\Models\Agent;
use App\Models\Chauffeur;
use App\Models\Entite;
use App\Models\Mission;
use App\Models\Pool;
use App\Models\User;
use App\Models\Ville;
use App\Events\Attr_event;
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
        $mission->load('entite', 'activite', 'agents', 'valideur', 'villeDesti', 'villeDep', 'dmdeur');
        $tab[] = null;
        $chauffeurs = Chauffeur::all();
        foreach ($mission->agents as $agent)
        {
            $tab[] = $agent->matricule;
        }
        $villes = Ville::all();
        $agents = Agent::all();
        $activites = Activite::all();
        $entites = Entite::whereHas('direction', function ($query) {
            $query->whereHas('entites', function ($query) {
                $query->whereHas('agents', function ($query) {
                    $query->where( 'matricule', auth()->user()->agent->matricule );
                });
            });
        })->get();

        $pools = Pool::whereHas('entites', function ($query) {
            $query->whereHas('direction', function ($query) {
                $query->whereHas('entites', function ($query) {
                    $query->whereHas('agents', function ($query) {
                        $query->where( 'matricule', auth()->user()->agent->matricule );
                    });
                });
            });
        })->get();

        $valideurs = User::whereHas('roles', function ($query) {
            $query->where( 'idRole', 7 );
        })->where('statut', 1)
            ->whereHas('agent', function ($query) {
                $query->whereHas('entite', function ($query) {
                    $query->where( 'id', auth()->user()->agent->entite->id );
                });
            })->get();

        return view('valideur/detailsDemande', compact('mission', 'pools', 'activites', 'entites', 'chauffeurs', 'valideurs', 'villes', 'agents', 'tab'));
    }

    public function valider(Request $request, Mission $mission) {
        if ($request->validation == 'valide') {
            $mission->validation = 1;
            $mission->save();
            try {
                //event(new Validation_event($mission));
                return redirect()->back()->with('info', 'validation éffectuée avec succès');
            }
            catch (\Swift_TransportException | \Swift_RfcComplianceException $e) {
                return redirect()->back()->with('info', 'validation éffectuée avec succès; Erreur d\'envoie de mail');
            }
        }
        if ($request->validation == 'invalide') {
            $mission->validation = 2;
            $mission->save();
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
