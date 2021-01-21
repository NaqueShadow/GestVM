<?php

namespace App\Http\Controllers;

use App\Events\Attr_event;
use App\Models\Attribution;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class AttributionController extends Controller
{

    public function store(Request $request)
    {
        $attribution = $request->all();
        $attribution['idChauf'] = Vehicule::find($request->idVehicule)->idChauf;

        $attr = Attribution::create($attribution);
        //event(new Attr_event($attr));

        return redirect()->route('respPool.detailsRequete', ['mission' => $request->idMission])->with('info', $request->idVehicule.' attribué avec succès');
    }

    public function store2(Request $request)
    {
        $attribution = $request->all();
        $attr = Attribution::create($attribution);
        //event(new Attr_event($attr));

        return redirect()->route('respPool.detailsRequete', ['mission' => $request->idMission])->with('info', $request->idVehicule.' attribué avec succès');
    }

    public function show($id) {  }

    public function edit($id) {  }

    public function update(Request $request, $id) {  }


    public function destroy(Attribution $attribution)
    {
        $attribution->delete();

        return back();
    }

    public function terminer(Attribution $attribution)
    {
        $attribution->statut = 0;
        $attribution->save();

        return back();
    }
}
