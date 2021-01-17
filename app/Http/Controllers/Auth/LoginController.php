<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            'password' => 'required|min:8',
        ]);

        if(auth()->attempt(array('login' => $input['login'], 'password' => $input['password']))) {

            if (auth()->user()->statut == 1) {
                return redirect()->route('agentMiss.index');
            }
            else {
                Auth::setUser(auth()->user()->id);
                Auth::logout();
                return redirect()->route('login')->with('error','compte inactif');
            }

            /*
            if (auth()->user()->role == 1) {
                return redirect()->route('agentMiss.index');
            }
            elseif (auth()->user()->role == 2) {
                return redirect()->route('chefGarage.index');
            }
            elseif (auth()->user()->role == 3) {
                return redirect()->route('chargeImp.index');
            }
            elseif (auth()->user()->role == 4) {
                return redirect()->route('respPool.attrEnCours');
            }
            elseif (auth()->user()->role == 5) {
                return redirect()->route('gestParc.index');
            }
            */

        }

        else {
            return redirect()->route('login')->with('error','identifiants incorrectes');
        }
    }
}
