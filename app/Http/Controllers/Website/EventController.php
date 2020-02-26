<?php

namespace App\Http\Controllers\Website;

use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function view(Request $request, $id){
        $event=PartnerEvent::active()->with(['partner', 'avgreviews', 'covers', 'facilities','gallery'])->with(['covers'=>function($cover){
            $cover->where('isactive', true);
        }])->with(['packages'=>function($package){
            $package->where('isactive', true)->where('partneractive', true)->with('activemenus');
        }])->findOrFail($id);

        //var_dump($event->gallery);die;
        if(!$event){
            return response()->json([
                'message'=>'invalid request',
                'errors'=>[

                ],
            ], 404);
        }
        //$event->time_to_start='very soon';
        //echo "<pre>";
        //print_r($event);die;
        return view('Website.event-detail', ['event'=>$event]);
    }
}
