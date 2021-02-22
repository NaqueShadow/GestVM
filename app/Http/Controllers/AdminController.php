<?php

namespace App\Http\Controllers;

use App\Imports\AgentImport;
use App\Models\Agent;
use App\Models\Categorie;
use App\Models\Entite;
use App\Models\Pool;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all()->load('pool');
        $pools = Pool::all();
        $agents = Agent::all();
        return view('admin/users', compact('users', 'pools', 'agents'));
    }

    public function rechercheUser(Request $request)
    {
        $text = $request->text;
        $pools = Pool::all();
        $agents = Agent::all();
        $users = User::where('login', 'like', '%'.$request->text.'%')
            ->orWhere('matricule', 'like', '%'.$request->text.'%')
            ->orWhereHas('agent', function ($query) use($request) {
                $query->where('nom', 'like', '%'.$request->text.'%')
                    ->orWhere('prenom', 'like', '%'.$request->text.'%');
            })->get();

        return view('admin/users', compact('users', 'agents', 'text', 'pools'));
    }

    public function store(Request $request)
    {
        $agent = $request->validate([
            'matricule' => 'required|numeric|unique:users|exists:agents,matricule',
            'login' => 'required|string|min:4|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'statut' => 'required',
        ]);

        User::create([
            'matricule' => $agent['matricule'],
            'login' => $agent['login'],
            'password' => bcrypt($agent['password']),
            'statut' => $agent['statut'],
        ]);

        return redirect()->route('admin.index')->with('info', 'compte créé avec succès');
    }

    public function show(User $user)
    {
        $pools = Pool::doesntHave('users')->get();
        $agents = Agent::all();
        $agent = Agent::find($user->agent->matricule);
        $roles = Role::whereDoesntHave('users', function ($query) use($user) {
            $query->where('idUser', $user->id );
        })->get();
        return view('admin.detailsUser', compact('user', 'pools', 'roles', 'agent', 'agents'));
    }

    public function update(Request $request, User $user)
    {
        $validate = $request->validate([

            'login' => 'required|string|min:4|max:255',
            'statut' => 'required',
        ]);

        $user->update($validate);
        return redirect()->route('admin.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index');
    }

    public function activer(User $user)
    {
        $user->statut = 1;
        $user->save();
        return redirect()->route('admin.index');
    }

    public function desactiver(User $user)
    {
        $user->statut = 0;
        $user->save();
        return redirect()->route('admin.index');
    }

    public function storeRole(Request $request, User $user)
    {
        $user->roles()->attach($request->role);
        return redirect()->back()->with('info', ' role attribué avec succès');
    }

    public function destroyRole(Request $request, User $user)
    {
        if ($request->role)
            $user->roles()->detach($request->role);
        return redirect()->back()->with('info', ' role retiré avec succès');
    }

    public function storePool(Request $request, User $user)
    {
        if ($request->pool)
            $user->pools()->attach($request->pool);
        return redirect()->back()->with('info', ' pool affecté avec succès');
    }

    public function destroyPool(Request $request, User $user)
    {
        $user->pools()->detach($request->pool);
        return redirect()->back()->with('info', ' pool retiré avec succès');
    }


    //******************

    public function indexAgent()
    {
        $agents = Agent::all();
        $categories = Categorie::all();
        $entites = Entite::all();
        $agent = new Agent();
        return view('admin/agents', compact('agents', 'entites', 'categories', 'agent'));
    }

    public function rechercheAgent(Request $request)
    {
        $text = $request->text;
        $agent = new Agent();
        $categories = Categorie::all();
        $entites = Entite::all();
        $agents = Agent::where('nom', 'like', '%'.$request->text.'%')
            ->orWhere('prenom', 'like', '%'.$request->text.'%')
            ->orWhere('matricule', 'like', '%'.$request->text.'%')
            ->get();

        return view('admin/agents', compact('agents', 'categories', 'entites', 'text', 'agent'));
    }

    public function storeAgent(Request $request)
    {
        if ($request->form == 1)
        {
            $agent = $request->validate([
                'matricule'=>'required|numeric|unique:App\Models\Agent,matricule',
                'nom'=>'required|min:2',
                'prenom'=>'required|min:2',
                'idCateg'=>'nullable|exists:categories,categorie',
                'idEntite'=>'nullable|exists:entites,id',
                'poste'=>'required|min:2',
                'email' => 'required|string|email|max:255|unique:agents|unique:chauffeurs',
                'telephone' => 'required|min:8|numeric|unique:agents|unique:chauffeurs',
            ]);
            Agent::create($agent);
        }

        elseif ($request->form == 2)
        {
            (new AgentImport)->import($request->file('fichier')->path(), null, \Maatwebsite\Excel\Excel::XLSX);
        }

        return redirect()->route('admin.indexAgent')->with('info', $request->nom.' '.$request->prenom.' enregistré avec succès');
    }

    public function editAgent(Agent $agent)
    {
        $categories = Categorie::all();
        $entites = Entite::all();
        return view('admin.editAgent', compact('agent', 'entites', 'categories'));
    }

    public function updateAgent(Request $request, Agent $agent)
    {
        $validate = $request->validate([
            'matricule'=>'required|numeric',
            'nom'=>'required|min:2',
            'prenom'=>'required|min:2',
            'poste'=>'nullable|min:2',
            'idCateg'=>'nullable|exists:categories,categorie',
            'idEntite'=>'nullable|exists:entites,id',
            'email' => 'required|string|email|max:255',
            'telephone' => 'required|min:8|numeric',
        ]);
        $agent->update($validate);
        return redirect()->route('admin.indexAgent');
    }

    public function destroyAgent(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('admin.indexAgent');
    }

    //***************************

    public function password(User $user)
    {
        return view('password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        if ( password_verify($request->ancienPass, $user->password) )
        {
            $validate = $request->validate([
                'passwd' => 'required|string|min:8|confirmed',
            ]);
            $user->password = bcrypt($validate['passwd']);
            $user->update();
            return redirect()->back()->with('passUpdated', 'Mot de passe modifié avec succes');
        }
        else
            return redirect()->back()->with('passError', 'Echec d\'authentification');
    }
}
