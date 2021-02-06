<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Chauffeur;
use App\Models\Mission;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function show( Mission $mission )
    {
        return view('agentMiss/detailsMission', compact('mission'));
    }


    public function edit(Mission $mission)
    {
        $tab[] = null;
        $chauffeurs = Chauffeur::all();
        $valideurs = User::whereHas('roles', function ($query) {
            $query->where( 'idRole', 7 );
        })->where('statut', 1)
            ->get();
        foreach ($mission->agents as $agent)
        {
            $tab[] = $agent->matricule;
        }
        $villes = Ville::all();
        $agents = Agent::all();
        return view('agentMiss/editMiss', compact('mission', 'chauffeurs', 'valideurs', 'villes', 'agents', 'tab'));
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


    public function destroy(Mission $mission)
    {
        $mission->delete();
        return back();
    }
}
