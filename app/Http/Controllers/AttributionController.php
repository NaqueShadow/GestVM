<?php

namespace App\Http\Controllers;

use App\Models\Attribution;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class AttributionController extends Controller
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
        $attribution = $request->all();
        $attribution['idChauf'] = Vehicule::find($request->idVehicule)->idChauf;

        Attribution::create($attribution);

        return redirect()->route('respPool.detailsRequete', ['mission' => $request->idMission])->with('info', $request->idVehicule.' attribué avec succès');
    }

    public function store2(Request $request)
    {
        $attribution = $request->all();

        Attribution::create($attribution);

        return redirect()->route('respPool.detailsRequete', ['mission' => $request->idMission])->with('info', $request->idVehicule.' attribué avec succès');
    }

    public function store3(Request $request)
    {
        $request->validate([
            'idEntite' => 'required',
            'idMission' => 'required',
            'idVehicule.*' => 'required|distinct',
            'idChauf.*' => 'distinct',
        ]);

        $attribution = array();
        $attribution['idMission'] = $request->idMission;
        $attribution['idEntite'] = $request->idEntite;

        foreach ( $request->idVehicule as $i => $vehicule )
        {
            if( empty($request->idChauf[$i]) )
                $attribution['idChauf'] = Vehicule::find($vehicule)->idChauf;
            else
                $attribution['idChauf'] = $request->idChauf[$i];

            if ($attribution['idChauf'] == null)
                $request->flash();
            return back()->with('erreur', '!! choisir un chauffeur disponible pour '.$vehicule);

        }

        foreach ( $request->idVehicule as $i => $vehicule )
        {
            $attribution['idVehicule'] = $vehicule;
            $attribution['statut'] = 1;
            if( empty($request->idChauf[$i]) )
                $attribution['idChauf'] = Vehicule::find($vehicule)->idChauf;
            else
                $attribution['idChauf'] = $request->idChauf[$i];

            Attribution::create($attribution);
        }


        return redirect()->route('respPool.requetes')->with('info', 'Opération d\'attribution réussie');
    }


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


    public function destroy(Attribution $attribution)
    {
        $attribution->delete();

        return back();
    }

    public function terminer(Attribution $attribution)
    {
        $attribution->statut = 0;
        $attribution->save();

        $vehicule = Vehicule::find($attribution->idVehicule);
        $vehicule->dernierRetour = now();
        $vehicule->save();

        return back();
    }
}
