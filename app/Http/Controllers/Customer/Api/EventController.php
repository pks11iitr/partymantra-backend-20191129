<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function view(Request $request, $id ){
        $event=PartnerEvent::active()->with(['partner', 'avgreviews', 'covers', 'facilities'])->with(['covers'=>function($cover){
            $cover->where('isactive', true);
        }])->with(['packages'=>function($package){
            $package->where('isactive', true)->where('partneractive', true)->with('activemenus');
        }])->findOrFail($id);
        if(!$event){
            return response()->json([
                'message'=>'invalid request',
                'errors'=>[

                ],
            ], 404);
        }
        //$event->time_to_start='very soon';
        return ['event'=>$event];
    }

    public function gallery(Request $request, $id){
        $product=PartnerEvent::findOrFail($id);
        return $product->gallery->where('isactive', true);
    }

    public function reviews(Request $request, $id){
        $product=PartnerEvent::findOrFail($id);
        return $product->reviews()->with(array('user'=>function($query){
            $query->select('id','name','image');
        }))->where('isactive', true)->get();
    }

}
