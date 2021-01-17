<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Mission;
use App\Models\Ville;
use Illuminate\Http\Request;

class MissionController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show( Mission $mission )
    {
        return view('agentMiss/detailsMission', compact('mission'));
    }


    public function edit(Mission $mission)
    {
        foreach ($mission->agents as $agent)
        {
            $tab[] = $agent->matricule;
        }

        $villes = Ville::all();
        $agents = Agent::all();
        return view('agentMiss/editMiss', compact('mission','villes', 'agents', 'tab'));
    }


    public function update(Request $request, Mission $mission)
    {
        $validate = $request->validate([
            'demandeur'=>'required',
            'objet'=>'min:3',
            'nbr'=>'required',
            'dateDepart' => 'required|date',
            'dateRetour' => 'required|date|after_or_equal:dateDepart',
            'villeDepart' => 'required',
            'villeDest' => 'required',
            'commentaire'=> 'min:0',
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
