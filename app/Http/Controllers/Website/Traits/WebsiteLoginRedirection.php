<?php


namespace App\Http\Controllers\Website\Traits;
use Illuminate\Http\Request;

trait WebsiteLoginRedirection
{
    public function redirectIfRequired($redirect, $data=[]){
        if (!auth()->user()){
            session(['redirect'=>$redirect]);
            if(request()->isMethod('post'))
                session(['requestdata'=>json_encode($data)]);
            //var_dump($request->all());die;
            return redirect()->route('login');

        }
        if(request()->isMethod('post'))
            session(['requestdata'=>json_encode($data)]);

        return null;
    }
}
