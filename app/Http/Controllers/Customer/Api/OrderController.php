<?php

namespace App\Http\Controllers\Customer\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /*
     * keep latest order in cart
     * on next order
     */
    public function bookevent(Request $request){
           $this->validate([
               'event_id'=>'required|integer',
               'package'=>'required|integer',
               'men'=>'required|integer|min:0',
               'women'=>'required|integer|min:0',
               'couple'=>'required|integer|min:0',
               'name'=>'required|string|max:20',
               'mobile'=>'required|integer',
               'email'=>'required|email'
           ]);
           if($request->men+$request->women+$request->couple <= 0){
               return response()->json([
                   'message'=>'please select valid member count',
                   'errors'=>[

                   ],
               ], 404);
           }
    }

    public function booktable(Request $request){

    }

    public function bookparty(Request $request){

    }
}
