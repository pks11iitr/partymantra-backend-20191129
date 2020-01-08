<?php

namespace App\Http\Controllers\Partner\Api;

use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function mark(Request $request, $refid){
        $user=auth()->user();
        $partner=$user->partner;
        $order=Order::with('details.entity.partner')->where('refid', $refid)->where()->firstOrFail();
        if($order->details[0]->entity->partner->id!=$partner->id){
            return response()->json([
                'status'=>'fail',
                'message'=>'You cannot accept this order',
                'errors'=>[

                ],
            ], 200);
        }
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
        $partner=$user->partner;
        $order=Order::with(['details.package', 'details.entity'])->where('refid', $id)->firstOrFail();
        if($order->details[0]->entity->partner->id!=$partner->id){
            return response()->json([
                'status'=>'fail',
                'message'=>'You cannot view this order',
                'errors'=>[

                ],
            ], 200);
        }

        $amount=0;
        $totalpass=0;

        foreach($order->details as $c){
            //$package=$c->package;
            $cartpackages[]=[
                'package'=>$c->package->package_name,
                'pass'=>$c->no_of_pass,
                'price'=>$c->package->price,
                'package_type'=>$c->package->package_type
            ];
            $title=$c->entity->title;
            $date=$c->entity->startdate.'-'.$c->entity->enddate;

            $amount=$amount+$c->no_of_pass*$c->price;

            $address=$c->entity->venue_address;
            $image=$c->entity->small_image;
            $totalpass=$totalpass+$c->no_of_pass;
        }
        return [
            'message'=>'success',
            'data'=>[
                'orderid'=>$order->refid,
                'title'=>$title,
                'image'=>$image,
                'address'=>$address,
                'packages'=>$cartpackages,
                'date'=>$date,
                'totalpass'=>$totalpass,
                'name'=>$order->name,
                'mobile'=>$order->mobile,
                'email'=>$order->email,
                'ratio'=>'Men: '.$order->men.' Women: '.$order->women.' Couple:'.$order->couple,
                'amount'=>$amount,
                'taxes'=>0,
                'qrcode'=>$order->payment_status=='paid'?route('api.order.qr', ['id'=>$order->id]):''
            ]
        ];
    }


    public function index(Request $request){
        $user=auth()->user();
        $partner=$user->partner;
        $orders=Order::whereHas('details', function($details) use($partner){
            $details->where('partner_id', $partner->id);
        })->whereIn('payment_status',['paid', 'cancelled'])->orderBy('updated_at','desc')->get();
        $orderarray=[];
        foreach($orders as $order){
            $orderarray[]=[
                'id'=>$order->id,
                'refid'=>$order->refid,
                'total'=>$order->total,
                'status'=>$order->payment_status
            ];
        }
        return [
            'message'=>'success',
            'data'=>$orderarray
        ];
    }
}
