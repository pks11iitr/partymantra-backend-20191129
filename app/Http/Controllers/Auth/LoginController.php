<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|integer|digits:10',
            'password' => 'required|string',
        ]);
    }

    public function username()
    {
        return 'mobile';
    }

    public function redirectTo(){
        if(auth()->user()->status==1) {
            foreach (config('allowedusers.admins') as $key => $value) {
                if (auth()->user()->hasRole($key)) {
                    if(stripos($value, 'http://')!==false)
                        return $value;
                    return route($value);
                }
            }
            Auth::logout();
            Session::flash('error', 'You dont have permissions to login here');
            return route('login');
        }else if(auth()->user()->status==0){
            Auth::logout();
            Session::flash('error', 'Account is not active');
            return route('login');
        }else{
            Auth::logout();
            Session::flash('error', 'Account has been blocked');
            return route('login');
        }
//        if(auth()->user()->hasRole('admin'))
//            return route('admin.dashboard');
//        else if(auth()->user()->hasRole('partner'))
//            return route('partner.dashboard');
//        else
//            abort(401);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('admin.login.form');
    }


}
