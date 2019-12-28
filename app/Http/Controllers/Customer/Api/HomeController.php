<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Banner;
use App\Models\Collection;
use App\Models\PartnerEvent;
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

        $banners=Banner::where('isactive', true)->orderBy('priority', 'asc')->where('priority', '<=', 10)->get();
        $otherbanners=Banner::where('isactive', true)->orderBy('priority', 'asc')->where('priority', '>', 10)->get();

        $collections=Collection::active()->where('istop', true)->whereHas($type,function($query){
            $query=$query->where('isactive',true)->where('partneractive', true);
        })->orderBy('priority', 'asc')->get();

        //return $collections;

        $othercollections=Collection::active()->with([$type=>function($query){
            return $query->with('avgreviews')->where('isactive',true)->where('partneractive', true)->orderBy('priority', 'asc');
        }])->where('istop', false)->orderby('priority', 'desc')->has($type)->get();

        return ['banners'=>$banners, 'collections'=>$collections, 'others'=>$othercollections, 'otherbanners'=>$otherbanners];

    }

    public function search(Request $request){
        if(!empty($request->search)){
            $events=PartnerEvent::active()
                ->with('partner')
                ->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('venue_adderss', 'like', '%'.$request->search.'%')
                ->orWhereHas('partner', function($query) use($request){
                    return $query->where('name', 'like', '%'.$request->search.'%');
                    })
                ->get()
                ->sortBy(function($event){
                    return $event->away;
                });
        }else{
            $events=PartnerEvent::active()
                ->with('partner')
                ->get()
                ->sortBy(function($event){
                return $event->away;
            });
        }
        return $events;
    }

}
