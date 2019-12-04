<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            /*
             * uncomment below line to view
             * default logged in page
             */
            //return redirect('/home');

            return $this->redirectTo();
        }

        return $next($request);
    }

    public function redirectTo(){
        foreach(config('allowedusers.admins') as $key=>$value){
            if(auth()->user()->hasRole($key)){
                return redirect(route($value));
            }
        }
        abort(401);
//        if(auth()->user()->hasRole('admin'))
//            return redirect(route('admin.dashboard'));
//        else if(auth()->user()->hasRole('partner'))
//            return redirect(route('partner.dashboard'));
//        else
//            abort(401);
    }
}
