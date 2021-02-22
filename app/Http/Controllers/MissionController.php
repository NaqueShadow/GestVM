<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Agent;
use App\Models\Chauffeur;
use App\Models\Entite;
use App\Models\Mission;
use App\Models\Pool;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function show( Mission $mission )
    {
        $mission->load('entite', 'activite', 'agents', 'valideur');
        return view('agentMiss/detailsMission', compact('mission'));
    }

    public function edit(Mission $mission)
    {
        $villes = Ville::All();
        $agents = Agent::all();
        $chauffeurs = Chauffeur::all();
        $activites = Activite::all();
        foreach ($mission->agents as $agent)
        {
            $tab[] = $agent->matricule;
        }

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

        return view('agentMiss/editMiss', compact('mission', 'pools', 'activites', 'entites', 'chauffeurs', 'valideurs', 'villes', 'agents', 'tab'));
    }

    public function update(Request $request, Mission $mission)
    {
        $validate = $request->validate([
            'demandeur'=>'required|exists:users,id',
            'objet'=>'min:3',
            'idValideur'=>'required|exists:users,id',
            'dateDepart' => 'required|date',
            'dateRetour' => 'required|date|after_or_equal:dateDepart',
            'villeDepart' => 'required',
            'villeDest' => 'required',
            'idActivite'=>'nullable|exists:activites,code',
            'idEntite'=>'nullable|exists:entites,id',
            'idPool'        => 'nullable|exists:pools,id',
            'typeV'=>'nullable',
            'codeV'=>'nullable|exists:vehicules,code',
            'idChauf'=>'nullable|exists:chauffeurs,matricule',
            'commentaire'=>'min:0',
        ]);
        $mission->update($validate);
        $mission->agents()->detach();
        foreach ($request->agent as $agent)
        {
            $mission->agents()->attach($agent);
        }

        return redirect()->route('agentMiss.index');
    }

    public function corriger(Request $request, Mission $mission)
    {
        $validate = $request->validate([
            'demandeur'=>'required|exists:users,id',
            'objet'         => 'min:3',
            'idValideur'    => 'required|exists:users,id',
            'dateDepart'    => 'required|date',
            'dateRetour'    => 'required|date|after_or_equal:dateDepart',
            'villeDepart'   => 'required',
            'villeDest'     => 'required',
            'idActivite'    => 'required|exists:activites,code',
            'idEntite'      => 'required|exists:entites,id',
            'typeV'         => 'nullable',
            'codeV'         => 'nullable|exists:vehicules,code',
            'idChauf'       => 'nullable|exists:chauffeurs,matricule',
            'idPool'        => 'required|exists:pools,id',
            'commentaire'   => 'min:0',
        ]);
        $mission->update($validate);
        $mission->agents()->detach();
        foreach ($request->agent as $agent)
        {
            $mission->agents()->attach($agent);
        }

        return redirect()->route('valideur.showMission', ['mission' => $mission->id]);
    }


    public function destroy(Mission $mission)
    {
        $mission->delete();
        return back();
    }
}
