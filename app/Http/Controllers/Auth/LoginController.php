<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        $user = User::firstWhere('email', $credentials['email']);

        if($user) {
            if (Auth::attempt($credentials) && !$user->is_bloked) {
                $request->session()->regenerate();
                
                
                $user->try_login = 0;
                $user->save();
    
                return redirect()->intended('home');
            }
    
            $this->checkTryLogin($user);
    
    
            if ($user->is_bloked) {
                
                $this->logout($request);
    
                return view('auth.login')->with([
                    'isBloked' => 'Ha realizado mas de 3 intentos. Esta cuenta se encuentra bloqueada. Comuniquese con un administrador',
                ]);
            }
    
            $try_login_available = 3 - $user->try_login;
    
            return view('auth.login')->with([
                'credentials' => 'Las credenciales no coinciden, intenta nuevamente. Intentos disponibles ' . $try_login_available,
            ]);
        }

        return view('auth.login')->with([
            'account_exist' => 'No existe una cuenta con esta direccion de correo',
        ]);        
    }

    protected function checkTryLogin($user)
    {
        $user->try_login = $user->try_login +=1;
        $user->save();

        if ($user->try_login >= 3) {
            $user->update(['is_bloked' => 1]);
            return false;
        }

        return true;
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
