<?php

namespace App\Http\Controllers;

use App\Exports\AttributionExport;
use App\Models\Attribution;
use App\Models\Ressource;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Jenssegers\Date\Date;
use Maatwebsite\Excel\Facades\Excel;

class ChargeImpController extends Controller
{
    public function __construct() {

        //$this->middleware('');
    }

    public function index()
    {
        $mois = today()->format('m');
        $annee = today()->format('Y');
        $a = Date::now()->firstOfMonth();
        $b = Date::now()->lastOfMonth();
        $attributions = Attribution::with('chauffeur', 'vehicule', 'entite', 'ressource')
            ->whereHas('mission', function ($query) use($a, $b) {
                $query->whereBetween('dateDepart', [$a, $b] );
            })->get();

        return view('chargeImp/index', compact('attributions', 'mois', 'annee'));
    }

    public function filtreMois(Request $request)
    {
        $mois = $request->mois;
        $annee = $request->annee;
        $a = Date::create($annee, $mois)->firstOfMonth();
        $b = Date::create($annee, $mois)->lastOfMonth(); //dd($a, $b);

        $attributions = Attribution::with('chauffeur', 'vehicule', 'entite', 'ressource', 'mission:id,dateDepart,dateRetour')
            ->whereHas('mission', function ($query) use($a, $b) {
                $query->whereBetween('dateDepart', [$a, $b] );
            })->get();

        return view('chargeImp/index', compact('attributions', 'mois', 'annee'));
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
        $annee = $request->annee;
        $a = Date::create($annee, $mois)->firstOfMonth();
        $b = Date::create($annee, $mois)->lastOfMonth();

        $attributions = Attribution::with('chauffeur', 'vehicule', 'entite', 'ressource','mission:id,dateRetour,dateDepart')
            ->where('idVehicule', $vehicule->code)
            ->whereHas('mission', function ($query) use($a, $b) {
                $query->whereBetween('dateDepart', [$a, $b] );
            })->get();

        return view('chargeImp/enregistrement', compact('attributions', 'mois', 'annee', 'vehicule'));
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
        $format = $request->type;
        $a = Date::create($request->annee, $request->mois)->firstOfMonth();
        $b = Date::create($request->annee, $request->mois)->lastOfMonth();

        if ($format === 'xlsx')
            return Excel::download (
                new AttributionExport($a, $b),
            'rapport_'. $a->format('F-Y') . '.xlsx',
            \Maatwebsite\Excel\Excel::XLSX
            );

        elseif ($format === 'csv')
            return (new AttributionExport($a, $b))->download (
                'rapport_'. $a->format('F-Y') . '.csv',
                \Maatwebsite\Excel\Excel::CSV,
                [
                    'Content-Type' => 'text/csv',
                ]
            );

        elseif ($format === 'pdf')
            return Excel::download (
                new AttributionExport($a, $b),
                'rapport_'. $a->format('F-Y') . '.pdf',
                \Maatwebsite\Excel\Excel::DOMPDF
            );

        else return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}
