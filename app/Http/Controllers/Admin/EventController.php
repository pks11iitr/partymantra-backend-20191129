<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    //
      public function index(Request $request){

    }

    public function edit(Request $request, $id){

    }

    public function add(Request $request){
        return view('siteadmin.events.add');
    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }
}
