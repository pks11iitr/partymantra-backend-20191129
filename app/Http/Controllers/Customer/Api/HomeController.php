<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Banner;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request){
        switch($request->type){
            case 'event': $type=$request->type;
            case 'restaurant': $type=$request->type;
            case 'party': $type=$request->type;
            default: $type='event';
        }

        $banners=Banner::where('isactive', true)->get()->toArray();

        $collections=Collection::active()->where('istop', true)->has($type)->get()->toArray();

        $othercollections=Collection::active()->where('istop', false)->orderby('priority', 'desc')->with($type)->get();

        return ['banners'=>$banners, 'collections'=>$collections, 'others'=>$othercollections];

    }

}
