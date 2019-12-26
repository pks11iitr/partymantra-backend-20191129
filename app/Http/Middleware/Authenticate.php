<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
//use Illuminate\Contracts\Auth\Factory as Auth1;
use Illuminate\Support\Facades\Session;
//use Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
//    public function __construct(Auth1 $auth)
//    {
//        parent::__construct($auth);
//        var_dump(auth()->user());die;
//        if(auth()->user()->status==1) {
//        }else if(auth()->user()->status==0){
//            Auth::logout();
//            Session::flash('error', 'Account is not active');
//            return redirect(route('login'));
//        }else if(auth()->user()->status==2){
//            Auth::logout();
//            Session::flash('error', 'Account has been blocked');
//            return redirect(route('login'));
//        }
//    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
