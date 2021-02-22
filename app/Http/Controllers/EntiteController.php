<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Direction;
use App\Models\Entite;
use Illuminate\Http\Request;

class EntiteController extends Controller
{
    public function indexActivite()
    {
        $mois = 2;
        $activites = Activite::all();

        return view('admin/entites/indexActivites', compact('activites', 'mois'));
    }

    public function editActivite(Activite $activite)
    {
        return view('admin/entites/editActivites', compact('activite'));
    }

    public function storeActivite(Request $request)
    {
        $activite = $request->validate([
            'code'            =>  'required|unique:App\Models\Activite,code',
            'designation'     =>  'required|min:5',
        ]);
        Activite::create($activite);

        return redirect()->route('activite.index')->with('info', ' enregistrement réussi');
    }

    public function updateActivite(Request $request, Activite $activite)
    {
        $validate = $request->validate([
            'code'            =>  'required',
            'designation'     =>  'required|min:5',
        ]);
        $activite->update($validate);
        return redirect()->route('activite.index');
    }

    public function destroyActivite(Activite $activite)
    {
        $activite->delete();
        return redirect()->route('activite.index');
    }

//***********************

    public function indexDirection()
    {
        $directions = Direction::all();

        return view('admin/entites/indexDirections', compact('directions'));
    }

    public function editDirection(Direction $direction)
    {
        return view('admin/entites/editDirections', compact('direction'));
    }

    public function storeDirection(Request $request)
    {
        $direction = $request->validate([
            'abbreviation'    =>  'required|unique:App\Models\Direction,abbreviation',
            'designation'     =>  'required|min:5',
        ]);
        Direction::create($direction);

        return redirect()->route('direction.index')->with('info', 'enregistrement réussi');
    }

    public function updateDirection(Request $request, Direction $direction)
    {
        $validate = $request->validate([
            'abbreviation'    =>  'required',
            'designation'     =>  'required|min:5',
        ]);
        $direction->update($validate);
        return redirect()->route('direction.index');
    }

    public function destroyDirection(Direction $direction)
    {
        $direction->delete();
        return redirect()->route('direction.index');
    }

//***********************

    public function indexEntite()
    {
        $idDr = null;
        $entites = Entite::all()->load('direction');
        $directions = Direction::all();

        return view('admin/entites/indexEntites', compact('entites', 'directions', 'idDr'));
    }

    public function filtreEntite(Request $request)
    {
        $idDr = $request->direction;
        $entites = Entite::where('idDirection', $idDr)->with('direction')->get();
        $directions = Direction::all();

        return view('admin/entites/indexEntites', compact('entites', 'directions', 'idDr'));
    }

    public function editEntite(Entite $entite)
    {
        $directions = Direction::all();
        return view('admin/entites/editEntites', compact('entite', 'directions'));
    }

    public function storeEntite(Request $request)
    {
        $entite = $request->validate([
            'abbreviation'    =>  'nullable|unique:App\Models\Entite,abbreviation',
            'designation'     =>  'required|min:5',
            'idDirection'     =>  'required|exists:directions,id',
        ]);
        Entite::create($entite);

        return redirect()->route('entite.index')->with('info', 'enregistrement réussi');
    }

    public function updateEntite(Request $request, Entite $entite)
    {
        $validate = $request->validate([
            'abbreviation'    =>  'nullable',
            'designation'     =>  'required|min:5',
            'idDirection'     =>  'required|exists:directions,id',
        ]);
        $entite->update($validate);
        return redirect()->route('entite.index');
    }

    public function destroyEntite(Entite $entite)
    {
        $entite->delete();
        return redirect()->route('entite.index');
    }
}
