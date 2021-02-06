<?php

namespace App\Http\Controllers;

use App\Models\Attribution;
use App\Models\Chauffeur;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Ville;
use App\Models\Agent;
use App\Models\Mission;
use Illuminate\Support\Facades\Session;
use Jenssegers\Date\Date;

class AgentMissController extends Controller
{

    public function __construct()
    {
       //
    }

    public function index()
    {
        $filtre = ['categorie' => '', 'periode' => '', 'date' => null];

        $missions = Mission::doesntHave('attributions')
            ->where( 'demandeur', '=', auth()->user()->id )
            ->where(function ($query){
                $query->where('dateRetour', '>', today())
                    ->orWhere('dateRetour', '=', today());
            })->orderBy('updated_at', 'DESC')
            ->get();

        return view('agentMiss/agentMiss', compact('missions', 'filtre'));
    }

    public function filtreDemande( Request $request )
    {
        $filtre = $request->all();
        $p = $filtre['periode'] == 'avant' ? '<' : ($filtre['periode'] == 'apres' ? '>=' : '=');

        $missions = Mission::doesntHave('attributions')
                ->where( 'demandeur', '=', auth()->user()->id )
                ->where(function ($query){
                    $query->where('dateRetour', '>', today())
                        ->orWhere('dateRetour', '=', today());
                })->orderBy('updated_at', 'DESC')
                ->get();

        if ( $filtre['categorie'] == 'nonTraite' )
            $missions = Mission::doesntHave('attributions')
                ->where( 'demandeur', '=', auth()->user()->id )
                ->where('dateRetour', '<', today())
                ->orderBy('updated_at', 'DESC')
                ->get();
        if ( $filtre['categorie'] == 'traite' )
            $missions = Mission::has('attributions')
                ->where( 'demandeur', '=', auth()->user()->id )
                ->orderBy('updated_at', 'DESC')
                ->get();

        if ( $filtre['periode'] != 'tous' )
            $missions = $missions
                ->where('updated_at', $p, $filtre['date']); //->format('Y-m-d')

        return view('agentMiss/agentMiss', compact('missions', 'filtre'));
    }

    public function filtreReponse(Request $request)
    {
        $filtre = $request->all();
        $p = $filtre['periode'] == 'avant' ? '<' : ($filtre['periode'] == 'apres' ? '>=' : '=');

        $attributions = Attribution::whereHas('mission', function ($query) {
            $query->where( 'demandeur', '=', auth()->user()->id );
        })->get();


        if ( $filtre['categorie'] == 'enCours' )
            $attributions =Attribution::whereHas('mission', function ($query) {
                $query->where( 'demandeur', '=', auth()->user()->id );
            })
                ->where('statut', 1)
                ->orderBy('updated_at', 'DESC')
                ->get();
        if ( $filtre['categorie'] == 'termine' )
            $attributions =Attribution::whereHas('mission', function ($query) {
                $query->where( 'demandeur', '=', auth()->user()->id );
            })->where('statut', 0)
                ->orderBy('updated_at', 'DESC')
                ->get();

        if ( $filtre['periode'] != 'tous' )
            $attributions = $attributions
                ->where('updated_at', $p, $filtre['date']); //->format('Y-m-d')

        return view('agentMiss/reponse', compact('attributions', 'filtre'));
    }

    public function newDemande()
    {
        $villes = Ville::All();
        $agents = Agent::all();
        $mission = new Mission();
        $chauffeurs = Chauffeur::all();
        $valideurs = User::whereHas('roles', function ($query) {
            $query->where( 'idRole', 7 );
        })->where('statut', 1)
            ->get();
        return view('agentMiss/demandeVehicule', compact('villes', 'chauffeurs', 'agents', 'valideurs', 'mission'));
    }

    public function reponse()
    {
        $filtre = ['categorie' => '', 'periode' => '', 'date' => null];

        $attributions = Attribution::whereHas('mission', function ($query) {
            $query->where( 'demandeur', '=', auth()->user()->id );
        })->where('statut', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('agentMiss/reponse', compact('attributions', 'filtre'));
    }

    public function showReponse( Attribution $attribution)
    {
        return view('agentMiss/detailsReponse', compact('attribution'));
    }


    public function storeDemande(Request $request)
    {
        //$d = Date::now()->format('d/m/Y');
        $mission = $request->validate([
            'demandeur'=>'required',
            'objet'=>'min:3',
            'idValideur'=>'required|exists:users,id',
            'dateDepart' => 'required|date',
            'dateRetour' => 'required|date|after_or_equal:dateDepart',
            'villeDepart' => 'required',
            'villeDest' => 'required',
            'typeV'=>'nullable',
            'codeV'=>'nullable|exists:vehicules,code',
            'idChauf'=>'nullable|exists:chauffeurs,matricule',
            'commentaire'=>'min:0',
        ]);

        $mission = Mission::create( $mission );
        foreach ($request->agent as $agent)
        {
            $mission->agents()->attach($agent);
        }

        return redirect()->route('agentMiss.index');
    }

}
