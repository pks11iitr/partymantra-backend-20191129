<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function view(Request $request, $id ){
        $event=PartnerEvent::with('partner')->find($id);
        if(!$event){
            return response()->json([
                'message'=>'invalid request',
                'errors'=>[

                ],
            ], 404);
        }

        return ['event'=>$event];
    }
}
