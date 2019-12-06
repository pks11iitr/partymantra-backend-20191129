<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    public function index(Request $request){

    }

    public function edit(Request $request, $id){

    }

    public function add(Request $request){
        return view('siteadmin.partners.add');
    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }


}
