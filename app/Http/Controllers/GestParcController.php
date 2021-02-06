<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\DocBord;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\Pool;

class GestParcController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $vehicules = Vehicule::all()->load('pool', 'chauffeur');
        $vehicule = new Vehicule();
        $categories = Categorie::all();

        return view('gestParc/vehicules/index', compact('vehicules', 'vehicule', 'categories'));
    }

    public function rechercheVehicule(Request $request)
    {
        $text = $request->text;
        $vehicules = Vehicule::nbrMiss()
            ->with('chauffeur')
            ->where('code', 'like', '%'.$request->text.'%')
            ->orWhere('modele', 'like', '%'.$request->text.'%')
            ->get();

        return view('gestParc/vehicules/index', compact('vehicules', 'text'));
    }

    public function indexChauffeurs()
    {
        $chauffeurs = Chauffeur::all();
        $chauf = new Chauffeur();
        $vehicules = Vehicule::doesnthave('chauffeur')->get();
        return view('gestParc/chauffeurs/index', compact('chauffeurs', 'chauf', 'vehicules'));
    }

    public function rechercheChauffeur(Request $request)
    {
        $text = $request->text;
        $chauffeurs = Chauffeur::nbrMiss()
            ->where('nom', 'like', '%'.$request->text.'%')
            ->orWhere('prenom', 'like', '%'.$request->text.'%')
            ->orWhere('matricule', 'like', '%'.$request->text.'%')
            ->get();

        return view('gestParc/chauffeurs/index', compact('chauffeurs', 'text'));
    }

    public function indexPools()
    {
        $pools = Pool::withCount('vehicules', 'chauffeurs')->get();
        $pool = new Pool();
        $regions = Region::all();
        return view('gestParc/pools/index', compact('pools', 'pool', 'regions'));
    }

    public function recherchePool(Request $request)
    {
        $text = $request->text;
        $pools = Pool::where('designation', 'like', '%'.$request->text.'%')
            ->orWhere('abbreviation', 'like', '%'.$request->text.'%')
            ->get();

        return view('gestParc/pools/index', compact('chauffeurs', 'text'));
    }

    public function indexDoc()
    {
        $filtre = ['type' => '', 'code' => ''];
        $docs = DocBord::where('type', '1' )
            ->with('vehicule')
            ->orderBy('etabl', 'DESC')->get();
        $vehicules = Vehicule::all();
        $docB = new DocBord();

        return view('gestParc/vehicules/docBord', compact('filtre', 'docs', 'vehicules', 'docB'));
    }

    public function storeDoc(Request $request)
    {
        $validate = $request->validate([
            'idVehicule'=>'required|exists:App\Models\Vehicule,code',
            'numero'=>'required|unique:doc_bords',
            'etabl'=>'required|date',
            'exp'=>'required|date|after_or_equal:etabl',
            'type'=>'required',
            'lieu'=>'required',
        ]);
        DocBord::create($validate);

        return redirect()->back();
    }

    public function editDoc(DocBord $doc)
    {
        return view('gestParc/vehicules/editDocBord', compact('doc'));
    }

    public function updateDoc(Request $request, DocBord $doc)
    {
        $validate = $request->validate([
            'numero'=>'required',
            'etabl'=>'required|date',
            'exp'=>'required|date|after_or_equal:etabl',
            'lieu'=>'required',
        ]);
        $doc->update($validate);

        return redirect()->route('gestParc.indexDoc');
    }

    public function filtreDoc( Request $request )
    {
        $filtre = $request->all();
        $docB = new DocBord();
        $vehicules = Vehicule::all();
        $docs = DocBord::where('type', '1' )->with('vehicule')
            ->orderBy('etabl', 'DESC')->get();

        if ( $filtre['type'] == '2' )
            $docs = DocBord::where('type', '2' )->with('vehicule')
                ->orderBy('etabl', 'DESC')->get();

        if ( $filtre['type'] == '3' )
            $docs = DocBord::where('type', '3' )->with('vehicule')
                ->orderBy('etabl', 'DESC')->get();

        if ( isset($filtre['code']) )
            $docs = $docs->where('idVehicule', $filtre['code']);


        return view('gestParc/vehicules/docBord', compact('filtre', 'docs', 'vehicules', 'docB'));
    }

    public function destroyDoc(Request $request)
    {
        if ($doc = DocBord::find($request->numero))
            $doc->delete();
        return redirect()->route('gestParc.indexDoc');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
