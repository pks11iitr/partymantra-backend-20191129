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
            break;
            case 'restaurant': $type=$request->type;
            break;
            case 'party': $type=$request->type;
            break;
            default: $type='event';
        }

        $banners=Banner::where('isactive', true)->get();

        $collections=Collection::active()->where('istop', true)->has($type)->get();

        //return $collections;

        $othercollections=Collection::active()->with($type)->where('istop', false)->orderby('priority', 'desc')->has($type)->get();

        return ['banners'=>$banners, 'collections'=>$collections, 'others'=>$othercollections];

    }

}
