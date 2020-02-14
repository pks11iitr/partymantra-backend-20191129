<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Collection;
use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CollectionController extends Controller
{
    public function index(Request $request){

        switch($request->type){
            case 'event': $type=$request->type;break;
            case 'restaurant': $type=$request->type;break;
            case 'party': $type=$request->type;break;
            default: $type='event';
        }

        $collections=Collection::active()->has($type)->where('collections.istop',true)->where('type', $type)->orderBy('priority', 'desc')->get();

        return ['collections'=>$collections];
    }

    public function events(Request $request, $id){
        $collection=Collection::find($id);
        if(!$collection)
            return response()->json([
                'message'=>'invalid request',
                'errors'=>[

                ],
            ], 404);
        //PartnerEvent::where('')

        $events=$collection->event()
            ->with('avgreviews')
            ->where('isactive',true)
            ->where('partneractive', true)
            ->orderBy('priority','asc')
            ->get()
            /*->sortBy(function($product){
                return $product->away;
            })*/;
        $i=0;
        foreach($events as $e){
            $events[$i]->rating=$e->avgreviews[0]->rating??0;
            $i++;
        }
        return ['events'=>$events,'image'=>$collection->cover_image];
    }

    public function restaurants(Request $request, $id){
        $collection=Collection::find($id);
        if(!$collection)
            return response()->json([
                'message'=>'invalid request',
                'errors'=>[

                ],
            ], 404);
        //PartnerEvent::where('')

        $events=$collection->restaurant()
            ->with('avgreviews')
            ->where('isactive',true)
            ->orderBy('priority','asc')
            ->get()
            /*->sortBy(function($product){
                return $product->away;
            })*/;
        $i=0;
        foreach($events as $e){
            $events[$i]->rating=$e->avgreviews[0]->rating??0;
            $i++;
        }
        return ['events'=>$events, 'image'=>$collection->cover_image];
    }

    public function party(Request $request, $id){
        $collection=Collection::find($id);
        if(!$collection)
            return response()->json([
                'message'=>'invalid request',
                'errors'=>[

                ],
            ], 404);
        //PartnerEvent::where('')

        $events=$collection->party()
            ->with('avgreviews')
            ->where('isactive',true)
            ->orderBy('priority','asc')
            ->get()
            /*->sortBy(function($product){
                return $product->away;
            })*/;
        $i=0;
        foreach($events as $e){
            $events[$i]->rating=$e->avgreviews[0]->rating??0;
            $i++;
        }
        return ['events'=>$events,'image'=>$collection->cover_image];
    }

}

