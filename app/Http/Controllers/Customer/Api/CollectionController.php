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
            case 'event': $type=$request->type;
            case 'restaurant': $type=$request->type;
            case 'party': $type=$request->type;
            default: $type='event';
        }

        $collections=Collection::active()->has($type)->orderBy('priority', 'desc')->get();

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

        return ['events'=>$collection->event()->with('avgreviews')->where('isactive',true)->where('partneractive', true)->get()];

    }


}

