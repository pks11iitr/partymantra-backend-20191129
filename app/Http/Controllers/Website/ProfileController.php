<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Website\Traits\WebsiteLoginRedirection;
use App\Models\Order;
use App\Models\Review;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function updateProfile(Request $request){

        $redirect=$this->redirectIfRequired(url()->previous());
        if($redirect)
            return $redirect;

        $request->validate([
            'name'=>'required|max:25',
            'email'=>'email',
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

        $user=auth()->user();
        $user->name=$request->name;
        $user->gender=$request->gender;
        $user->dob=$request->dob;
        $user->email=$request->email;
        $user->address=$request->address;
        $user->image=$path;
        if(!$user->save()){
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->back()->with('success', 'Profile has been updated');
    }
}
