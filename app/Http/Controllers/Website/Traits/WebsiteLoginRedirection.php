<?php


namespace App\Http\Controllers\Website\Traits;
use Illuminate\Http\Request;

trait WebsiteLoginRedirection
{
    public function redirectIfRequired($redirect, $data=[]){
        if (!auth()->user()){
            session(['redirect'=>$redirect]);
            if(request()->isMethod('post')){
                if(!empty($data))
                    session(['requestdata'=>json_encode($data)]);
            }
            return redirect()->route('login');
        }
        return null;
    }
}
