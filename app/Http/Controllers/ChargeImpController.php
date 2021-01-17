<?php

namespace App\Http\Controllers;

use App\Exports\AttributionExport;
use App\Models\Attribution;
use App\Models\Ressource;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Jenssegers\Date\Date;

class ChargeImpController extends Controller
{
    public function __construct() {

        //$this->middleware('');
    }

    public function index()
    {
        $mois = today()->format('Y-m');
        $a = Date::now()->firstOfMonth();
        $b = Date::now()->lastOfMonth();
        $attributions = Attribution::with('chauffeur', 'vehicule', 'entite', 'ressource')
            ->whereHas('mission', function ($query) use($a, $b) {
                $query->whereBetween('dateDepart', [$a, $b] );
            })->get();

        return view('chargeImp/index', compact('attributions', 'mois'));
    }

    public function filtreMois(Request $request)
    {
        $mois = $request->mois;
        $date1 = Date::create(substr($mois,0,4), substr($mois,5,2));
        $date2 = Date::create(substr($mois,0,4), substr($mois,5,2));
        $a = $date1->firstOfMonth(); $b = $date2->lastOfMonth(); //dd($a, $b);

        $attributions = Attribution::with('chauffeur', 'vehicule', 'entite', 'ressource', 'mission:id,dateDepart,dateRetour')
            ->whereHas('mission', function ($query) use($a, $b) {
                $query->whereBetween('dateDepart', [$a, $b] );
            })->get();

        return view('chargeImp/index', compact('attributions', 'mois'));
    }

    public function indexVehicules()
    {
        $vehicules = Vehicule::orderBy('code')->get();
        return view('chargeImp/vehicules', compact('vehicules'));
    }

    public function rechercheVehicule(Request $request)
    {
        $text = $request->text;
        $vehicules = Vehicule::nbrMiss()
            ->with('chauffeur')
            ->where('code', 'like', '%'.$request->text.'%')
            ->orWhere('modele', 'like', '%'.$request->text.'%')
            ->get();

        return view('chargeImp/vehicules', compact('vehicules', 'text'));
    }


    public function indexEnregistrement(Vehicule $vehicule)
    {
        $mois = today()->format('Y-m');
        $a = Date::now()->firstOfMonth();
        $b = Date::now()->lastOfMonth();
        $attributions = Attribution::with('chauffeur', 'vehicule', 'entite', 'ressource')
            ->where('idVehicule', $vehicule->code)
            ->whereHas('mission', function ($query) use($a, $b) {
                $query->whereBetween('dateDepart', [$a, $b] );
            })->get();

        return view('chargeImp/enregistrement', compact('attributions', 'mois', 'vehicule'));
    }


    public function filtreMoisVehicule(Request $request, Vehicule $vehicule)
    {
        $mois = $request->mois;
        $a = Date::create(substr($mois,0,4), substr($mois,5,2))->firstOfMonth();
        $b = Date::create(substr($mois,0,4), substr($mois,5,2))->lastOfMonth();
        $attributions = Attribution::with('chauffeur', 'vehicule', 'entite', 'ressource','mission:id,dateRetour,dateDepart')
            ->where('idVehicule', $vehicule->code)
            ->whereHas('mission', function ($query) use($a, $b) {
                $query->whereBetween('dateDepart', [$a, $b] );
            })->get();

        return view('chargeImp/enregistrement', compact('attributions', 'mois'));
    }


    public function create()
    {
        //
    }


    public function storeRessource(Request $request)
    {
        $validate = $request->validate([
            'idAttr' => 'required',
            'carburant' => 'required|numeric',
            'comptDepart' => 'required|numeric',
            'comptRetour' => 'required|numeric',
        ]);
        $ressource = Ressource::find($validate['idAttr']);
        if ( $ressource )
            $ressource->update($validate);
        else
            Ressource::create($validate);

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function rapport(Request $request)
    {
        /*return Excel::create('rapport_'. today()->format('F-Y'), function($excel) {

            // Set the title
            $excel->setTitle('Rapport d\'utilisation de vehicules');

        })->export('xlsx');*/

        return Excel::download(new AttributionExport(), 'rapport_'. today()->format('F-Y') .'.xlsx');
    }


    public function destroy($id)
    {
        //
    }
}
