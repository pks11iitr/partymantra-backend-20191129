<?php

namespace App\Http\Controllers\Customer\Api;

use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
           //'email'=>'required|email',
           'gender'=>'required|in:male,female,other',
           'dob'=>'required|date_format:Y-m-d',
            'image'=>'nullable|image'
        ]);

        if(!empty($request->image)){
            $file = $request->image->path();

            $name = str_replace(' ', '_', $request->image->getClientOriginalName());

            $path = 'users/' . $name;

            Storage::put($path, file_get_contents($file));
        }else{
            $path=DB::raw('image');
        }

        $user=$this->auth->user();
        $user->name=$request->name;
        $user->gender=$request->gender;
        $user->dob=$request->dob;
        $user->email=$request->email;
        $user->image=$path;
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
        return $user->only('name', 'dob', 'email', 'mobile', 'address', 'gender','image');
    }
}
