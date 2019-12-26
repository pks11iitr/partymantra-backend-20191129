<?php

namespace App\Http\Controllers\Partner\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function mark(Request $request, $refid){
        $order=Order::where('refid', $refid)->firstOrFail();
        if($order->entry_marked==true){
            return response()->json([
                'status'=>'fail',
                'message'=>'Pass has been already used',
                'errors'=>[

                ],
            ], 200);
        }

        $order->entry_marked=true;
        if($order->save()){
            return response()->json([
                'status'=>'success',
                'message'=>'Please allow entry',
                'errors'=>[

                ],
            ], 200);
        }
    }
}
