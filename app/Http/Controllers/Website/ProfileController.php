<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Website\Traits\WebsiteLoginRedirection;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    use WebsiteLoginRedirection;

    public function view(Request $request){

        $redirect=$this->redirectIfRequired(url()->full());
        if($redirect)
            return $redirect;

        $user=auth()->user();

        $wallethistory=Wallet::where('user_id', $user->id)->where('iscomplete', true)->orderBy('id','desc')->get();

        $balance=Wallet::balance($user->id);


        return view('Website.profile', compact('user', 'wallethistory', 'balance'));
    }
}
