<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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
    //protected $redirectTo = '/operaciones';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectTo(){
        if(Auth::user()->hasRole('Admin')){
            return "/operaciones";
        }
        if(Auth::user()->hasRole('User')){
            return "/departamento";
        }
        return "/auth.login";
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
