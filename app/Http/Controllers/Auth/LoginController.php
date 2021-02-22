<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {

        $input = $request->all();
        $this->validate($request, [
            'login' => 'required|min:4',
            'password' => 'required',
            'role' => 'required'
        ]);

        if(auth()->attempt(array('login' => $input['login'], 'password' => $input['password']))) {

            if (auth()->user()->statut == 'actif') {

                if ($input['role'] == 2) {
                    return redirect()->route('chefGarage.index');
                }
                elseif ($input['role'] == 3) {
                    return redirect()->route('chargeImp.index');
                }
                elseif ($input['role'] == 4) {
                    return redirect()->route('respPool.attrEnCours');
                }
                elseif ($input['role'] == 5) {
                    return redirect()->route('gestParc.index');
                }
                elseif ($input['role'] == 6) {
                    return redirect()->route('admin.index');
                }
                elseif ($input['role'] == 7) {
                    return redirect()->route('valideur.index');
                }
                return redirect()->route('agentMiss.index');
            }
            else {
                $request->session()->flush();
                $request->session()->regenerate();
                return redirect()->route('login')->with('error','compte inactif');
            }
        }

        else {
            return redirect()->route('login')->with('error','identifiants incorrectes');
        }
    }
}
