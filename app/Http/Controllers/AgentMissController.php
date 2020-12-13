<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;
use App\Models\Agent;
use App\Models\Mission;
use Illuminate\Support\Facades\Session;

class AgentMissController extends Controller
{

    protected $guarded = [];

    public function index()
    {
        $missions = Mission::where( 'demandeur', '=', auth()->user()->id )->get();
        $missions->load('agents');
        $missions->load('villeDesti');
        $missions->load('villeDep');

        return view('agentMiss/agentMiss', compact('missions'));
    }

    public function createMission()
    {
        $villes = Ville::All();

        return view('agentMiss/demandeVehicule', compact('villes'));
    }


    public function initDemanderVehicule(Request $request)
    {
        $dmd = $request->validate([
            'objet'=>'min:3',
        ]);

        //session
        Session::put('mission.demandeur', $request->demandeur);
        Session::put('mission.objet', $request->objet);
        Session::put('mission.dateDepart', $request->dateDepart);
        Session::put('mission.dateRetour', $request->dateRetour);
        Session::put('mission.villeDepart', $request->villeDepart);
        Session::put('mission.villeDest', $request->villeDest);
        Session::put('mission.commentaire', $request->commentaire);

        $agents = Agent::All();

        return view('agentMiss/participant', compact('agents'));
    }

    public function demanderVehicule(Request $request)
    {
        $mission = new Mission;
        $mission->demandeur = session('mission.demandeur' );
        $mission->objet = session('mission.objet');
        $mission->dateDepart = session('mission.dateDepart');
        $mission->dateRetour = session('mission.dateRetour');
        $mission->villeDepart = session('mission.villeDepart');
        $mission->villeDest = session('mission.villeDest');
        $mission->save();

        $mission->agents()->attach($request->ag1);

        if ($request->ag2)
            $mission->agents()->attach($request->ag2);
        if ($request->ag3)
            $mission->agents()->attach($request->ag3);
        if ($request->ag4)
            $mission->agents()->attach($request->ag4);
        if ($request->ag5)
            $mission->agents()->attach($request->ag5);

        $request->session()->forget(['demandeur', 'objet','dateDebut','dateRetour','villeDepart','villeDest','commentaire']);

        return redirect()->route('agentMiss.index');
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
