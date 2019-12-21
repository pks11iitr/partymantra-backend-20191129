<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TncController extends Controller
{
    public function tnc(){
        return view('Website.tnc');
    }

    public function privacy(){
        return view('Website.privacy');
    }

    public function about(){
        return view('Website.about');
    }
}
