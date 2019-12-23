<?php

namespace App\Http\Controllers\Customer\Api;

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
        $request->validate([
            'address'=>'required|max:150',
            'lat'=>'required|numeric',
            'lang'=>'required|numeric'
        ]);

        $user=$this->auth->user();
        $user->address=$request->address;
        $user->lat=$request->lat;
        $user->lang=$request->lang;
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
        $request->validate([
           'name'=>'required|max:25',
           'email'=>'required|email',
           'gender'=>'required|in:male,female,other',
           'dob'=>'required|date_format:Y-m-d'
        ]);
        $user=$this->auth->user();
        $user->name=$request->name;
        $user->gender=$request->gender;
        $user->dob=$request->dob;
        $user->email=$request->email;
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

    public function getProfileInfo(Request $request){
        $user=$this->auth->user();
        return $user->only('name', 'dob', 'email', 'mobile', 'address', 'gender');
    }
}
