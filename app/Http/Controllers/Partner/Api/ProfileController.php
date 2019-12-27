<?php

namespace App\Http\Controllers\Partner\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profile(Request $request){
        $user=auth()->user();
        $partner=$user->partner;
        if($partner)
            return ['status'=>'success', 'partner'=>$partner];
        return ['status'=>'fail', 'partner'=>[]];
    }
}
