<?php

namespace App\Http\Controllers\Auth\Website;
use App\Services\SMS\Msg91;
//use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\OTPModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    public function __construct()
    {
        $this->redirectTo=route('website.home');
        $this->middleware('website.guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('Website.auth.login');
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
            'mobile' => ['required', 'digits:10'],
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
            'password' => Hash::make($data['mobile']),
            'token'=>$data['token']??null
        ]);
    }


    public function login(Request $request){
        $this->validator($request->toArray())->validate();
        $user=$this->ifUserExists($request->mobile);
        if(!$user){
            if($user = $this->create($request->all())){
                $user->assignRole('customer');
                if($otp=OTPModel::createOTP($user->id, 'login')){
                    $msg=config('sms-templates.login-otp');
                    $msg=str_replace('{{otp}}', $otp, $msg);
                    if(Msg91::send($request->mobile, $msg)){

                    }
                }
            }
        }else if(!in_array($user->status, [0 , 1])){
            //send OTP
            return redirect()->back()->with('error', 'Account has been blocked');
        }else{

            $user->token=$request->token??null;
            $user->save();
            if($otp=OTPModel::createOTP($user->id, 'login')){
                $msg=config('sms-templates.login-otp');
                $msg=str_replace('{{otp}}', $otp, $msg);
                if(Msg91::send($request->mobile, $msg)){

                }
            }
        }
        return redirect()->route('otp.verify')->with('mobile', $request->mobile);
    }

    protected function ifUserExists($mobile){
        return (User::where('mobile', $mobile)->first())??false;
    }


    //verify OTP for authentication
    public function verifyOTP(Request $request){

        $this->validator($request->toArray())->validate();
        $user=User::where('mobile', $request->mobile)->first();
        if(!$user)
        {
            return redirect()->route('login.form')->with('error', 'Invalid Request');
        }
        else if(!in_array($user->status, [0 , 1]))
        {
            return redirect()->route('login.form')->with('error', 'User account has been blocked');
        }

        if(!OTPModel::verifyOTP($user->id, 'login', $request->otp)){
            $request->session()->flash('mobile', $request->session()->get('mobile'));
            return redirect()->back()->with('error', 'Otp is not correct');
        }

        //activate user if not activated
        if($user->status==0){
            $user->status=1;
            $user->save();
        }
        Auth::loginUsingId($user->id, 1);
        if($request->session()->get('redirect')){
            //echo $request->session()->get('redirect');
            //die;
            return redirect()->intended($request->session()->get('redirect'));
        }
        else
            return redirect()->intended($this->redirectTo);

    }

    public function OTPForm(Request $request){

        if(!$request->session()->get('mobile')){
            return redirect()->route('login.form');
        }
        $request->session()->flash('mobile', $request->session()->get('mobile'));
        return view('Website.auth.otp-verify', ['mobile'=>$request->session()->get('mobile')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('website.home');
    }

}
