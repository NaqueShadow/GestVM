<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{

    public function index()
    {
        $interventions = Intervention::all();

        return view('chefGarage/historique', compact('interventions'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validate = $request->validate([

            'idVehicule'=>'required|min:3',
            'debut'=>'required|date',
            'finPrev'=>'required|date',
            'type'=>'required'
        ]);

        Intervention::create($validate);

        return back();
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
