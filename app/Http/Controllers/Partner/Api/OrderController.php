<?php

namespace App\Http\Controllers\Partner\Api;

use App\Models\Order;
use App\Models\Package;
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

        //$order->entry_marked=true;
        if($order->save()){
            return response()->json([
                'status'=>'success',
                'message'=>'Please allow entry',
                'errors'=>[

                ],
            ], 200);
        }
    }


    public function details(Request $request, $id){
        $user=auth()->user();
        $order=Order::where('refid', $id)->firstOrFail();
        $details=$order->details;

        foreach($details as $d){
            $product=$d->entity;
            $detail=$d;
        }
        if($detail->partner_id!=$user->partner->id)
            abort(404);

        $package=Package::findOrFail($detail->other_id);
        return [
            'message'=>'success',
            'data'=>[
                'orderid'=>$order->refid,
                'title'=>$product->title,
                'package'=>$package->package_name,
                'image'=>$product->small_image,
                'date'=>$product->startdate.'-'.$product->enddate,
                'totalpass'=>$detail->men+$detail->women+$detail->couple,
                'name'=>$detail->name,
                'mobile'=>$detail->mobile,
                'email'=>$detail->email,
                'ratio'=>'Men: '.$detail->men.' Women: '.$detail->women.' Couple:'.$detail->couple,
                'amount'=>$order->total,
                'taxes'=>0,
            ]
        ];
    }
}
