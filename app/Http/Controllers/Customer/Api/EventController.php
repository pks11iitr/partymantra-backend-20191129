<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function view(Request $request, $id ){
        $event=PartnerEvent::active()->with(['partner', 'packages.activemenus', 'avgreviews', 'covers'])->findOrFail($id);
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
