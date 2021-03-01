<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit(Request $request){
        return view('siteadmin.change-password.edit');
    }

    public function update(Request $request){
        $request->validate([
            'password'=>'required',
            'confirm_password'=>'required|same:password',
        ]);

        $user = Auth::user();

        if($user->update([
            'password'=> Hash::make($request->password),
        ]))
        {
            return redirect()->back()->with('success', 'Your new password has been updated successfully.');
        }
        return redirect()->back()->with('error', 'Password update failed');
    }
}
