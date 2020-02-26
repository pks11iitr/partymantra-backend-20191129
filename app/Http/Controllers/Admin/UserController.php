<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;

class UserController extends Controller
{
    public function index(Request $request){

        $users=User::role('customer')->paginate(10);

        return view('siteadmin.users.index', ['users'=>$users]);


    }
}
