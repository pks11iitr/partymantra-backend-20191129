<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;

class ProfileController extends Controller
{

    public function __construct(Auth $auth, JWTAuth $jwt)
    {
        $this->jwt=$jwt;
        $this->auth=$auth;
    }

    public function updateAddress(Request $request){
        $user=$this->auth->user();

        $user->address=$request->address;
        if(!$user->save()){
            return response()->json([
                'message'=>'some error occurred',
                'errors'=>[

                ],
            ], 404);
        }
        return [
            'message'=>'Address has been updated'
        ];
    }


    public function updateProfile(Request $request){
        $user=$this->auth->user();

        $user->address=$request->address;
        if(!$user->save()){
            return response()->json([
                'message'=>'some error occurred',
                'errors'=>[

                ],
            ], 404);
        }
        return [
            'message'=>'Address has been updated'
        ];
    }
}
