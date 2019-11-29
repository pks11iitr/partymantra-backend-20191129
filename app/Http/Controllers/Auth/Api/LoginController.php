<?php

namespace App\Http\Controllers\Auth\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt=$jwt;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'integer', 'digits:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['mobile'])
        ]);
    }


    public function login(Request $request){
        $this->validator($request->toArray())->validate();
        $user=$this->ifUserExists($request->mobile);
        if(!$user){
            if($user = $this->create($request->all())){
                //event(new Registered($user));
                //sendotp
            }
        }else if(!($user->status==0 || $user->status==1)){
            //send OTP
            return response()->json([
                'message'=>'invalid login attempt',
                'errors'=>[

                ],
            ], 404);
        }
        return [
            'message'=>'Please verify OTP to continue'
        ];


    }

    protected function ifUserExists($mobile){
        return (User::where('mobile', $mobile)->first())??false;
    }


    //verify OTP for authentication
    public function verifyOTP(Request $request){
        $this->validate($request, [
            'mobile' => ['required', 'integer', 'digits:10'],
            'otp' => ['required', 'integer', 'digits:6'],
        ]);

        $user=User::where('mobile', $request->mobile)->first();

        if(!$user){
            return response()->json([
                'message'=>'invalid login attempt',
                'errors'=>[
                ],
            ], 404);
        }else if(!($user->status==0 || $user->status==1)){
            return response()->json([
                'message'=>'account is not active',
                'errors'=>[

                ],
            ], 401);
        }
        if($user->status==0){

            $user->status=1;
            $user->save();
        }
        //var_dump($user->status);die;
        return [
            'message'=>'Login Successfull',
            'token'=>$this->jwt->attempt(['password'=>$request->mobile, 'mobile'=>$request->mobile])
        ];

    }

    public function home(Request $request){
        return ['message'=>'user home page'];
    }


}
