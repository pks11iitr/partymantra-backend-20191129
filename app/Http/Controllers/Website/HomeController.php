<?php

namespace App\Http\Controllers\Website;

use App\Models\Banner;
use App\Models\Collection;
use App\Models\Partner;
use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {

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
        $otherbanners=Banner::where('isactive', true)
            ->where('entity_type', $type)->where('placeholder',  '>',1)
            ->orderBy('priority', 'asc')->get();
        //echo "<pre>";

        /*
         * Group banners as per position of plaeholder
         */
        $bannerorder=[];
        foreach($otherbanners as $banner){
            if(!isset($bannerorder[$banner->placeholder-1])){
                $bannerorder[$banner->placeholder-1]=[];
            }
            $bannerorder[$banner->placeholder-1][]=$banner;
        }
        unset($otherbanners);
        //var_dump($bannerorder);die;

        /*
         * get top collections for entity type
         */
        $collections=Collection::active()->where('istop', true)->where('type', $type)->whereHas($type,function($query) use($type){
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
        $othercollections=Collection::active()->where('type', $type)->with([$type=>function($query) use($type){
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
        //  var_dump($collectionswithbanner);die;
        return view('Website.home', ['banners'=>$banners, 'collections'=>$collections, 'others'=>$collectionswithbanner, 'otherbanners'=>[], 'type'=>$type]);

    }

    public function search(Request $request){
        if(!empty($request->search)){
            $events=PartnerEvent::active()
                ->with('partner')
                ->where(function($query) use ($request){
                    $query->where('title', 'LIKE', "%$request->search%")
                        ->orWhere('venue_adderss', 'like', "%$request->search%")
                        ->orWhereHas('partner', function($query) use($request){
                            return $query->where('name', 'like', "%$request->search%");
                        });
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

        if(!empty($request->search)){
            $restaurants=Partner::active()
                ->where(function($query) use ($request){
                    $query->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('address', 'like', '%'.$request->search.'%');

                })
                ->get()
                ->sortBy(function($event){
                    return $event->away;
                });
        }else{
            $restaurants=Partner::active()
                ->get()
                ->sortBy(function($event){
                    return $event->away;
                });
        }

        if(!empty($request->search)){
            $parties=Partner::active()
                ->where('allow_party', true)
                ->where(function($query) use ($request){
                    $query->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('address', 'like', '%'.$request->search.'%');

                })
                ->get()
                ->sortBy(function($event){
                    return $event->away;
                });
        }else{
            $parties=Partner::active()
                ->where('allow_party', true)
                ->get()
                ->sortBy(function($event){
                    return $event->away;
                });
        }

        return view('Website.search-results',compact('events','restaurants','parties'));
    }

    public function check(){
        echo 'status1';die;// for ok
        echo 'status2';die;// for block
        echo 'status3';die;//for delete
    }

    public function setLocation(Request $request){
        $request->validate([
           'lat'=>'required|numeric',
           'lang'=>'required|numeric',
            'adderss'=>'requierd|string'
        ]);

        session(['lat'=>$request->lat, 'lang'=>$request->lang, 'address'=>$request->address]);
        return [
            'status'=>'success'
        ];

    }

}
