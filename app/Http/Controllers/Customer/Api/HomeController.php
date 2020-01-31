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

        /*
         * get all banners for entity type
         */
        $banners=Banner::where('isactive', true)->where('entity_type', $type)->orderBy('priority', 'asc')->where('placeholder',  1)->get();
        $otherbanners=Banner::where('isactive', true)->where('entity_type', $type)->orderBy('priority', 'asc')->get();

        /*
         * Group banners as per position of plaeholder
         */
        $bannerorder=[];
        foreach($otherbanners as $banner){
            if(!isset($bannerorder[$banner->placeholder])){
                $bannerorder[$banner->placeholder]=[];
            }
            $bannerorder[$banner->placeholder][]=$banner;
        }
        unset($otherbanners);


        /*
         * get top collections for entity type
         */
        $collections=Collection::active()->where('istop', true)->whereHas($type,function($query) use($type){
            if($type=='event')
                $query->where('isactive',true)->where('partneractive', true);
            else if($type=='party')
                $query->where('isactive',true)->where('allow_party', true);
            else
                $query->where('isactive',true);
        })->orderBy('priority', 'asc')->get();

        /*
         * get other collections for entity type
         */
        $othercollections=Collection::active()->with([$type=>function($query) use($type){
            if($type=='event')
                return $query->with('avgreviews')->where('isactive',true)->where('partneractive', true)->orderBy('priority', 'asc');
            else if($type=='party')
                return $query->with('avgreviews')->where('isactive',true)->where('allow_party', true)->orderBy('priority', 'asc');
            else
                return $query->with('avgreviews')->where('isactive',true)->orderBy('priority', 'asc');
        }])->where('istop', false)->orderby('priority', 'desc')->has($type)->get();


        /*
         * Add placeholder banner to placeholer collection
         */
        $i=0;
        $placeholderno=1;
        $collectionswithbanner=[];
        foreach($othercollections as $c){
            if($i%2!=0 && isset($bannerorder[$placeholderno])){
                $c->banners=$bannerorder[$placeholderno];
                $placeholderno++;

            }
            $collectionswithbanner[]=$c;
            $i++;
        }
        unset($othercollections);
        //return $collections;

        return ['banners'=>$banners, 'collections'=>$collections, 'others'=>$collectionswithbanner, 'otherbanners'=>[]];

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
