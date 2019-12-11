<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Partner;
use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /*
     * keep latest order in cart
     * on next order
     */


    public function addtocart(Request $request){
        $request->validate([
            'type'=>'required|in:event',
            'itemid'=>'required|integer',
            'men'=>'required|integer|min:0',
            'women'=>'required|integer|min:0',
            'couple'=>'required|integer|min:0',
            'name'=>'required|string|max:50',
            'mobile'=>'required|integer|digits:10',
            'email'=>'required|email'
        ]);
        if($request->men+$request->women+$request->couple <= 0){
            return response()->json([
                'message'=>'please select valid member count',
                'errors'=>[

                ],
            ], 200);
        }

        //clear previous cart
        auth()->user()->cart()->delete();

        switch($request->type){
            case 'event': return $this->addEventToCart($request);
        }

    }

    private function addEventToCart(Request $request){

        $package=Package::findOrFail($request->itemid);
        if($cart=Cart::updateOrCreate(['user_id'=>auth()->user()->id], [
            'entity_type'=>'App\Models\PartnerEvent',
            'entity_id'=>$package->event_id,
            'other_id'=>$package->id,
            'men'=>$request->men,
            'women'=>$request->women,
            'couple'=>$request->couple,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'name'=>$request->name,

        ])){
            return [
                'message'=>'success',
                'data'=>[
                    'title'=>$package->event->title,
                    'date'=>$package->event->startdate.'-'.$package->event->enddate,
                    'total'=>$cart->men+$cart->women+$cart->couple,
                    'ratio'=>'Men: '.$cart->men.' Women: '.$cart->women.' Couple:'.$cart->couple,
                    'amount'=>($cart->men+$cart->women+$cart->couple)*$package->price
                ]
            ];
        }
        return response()->json([
            'message'=>'some error occurred',
            'errors'=>[

            ],
        ], 404);

    }

    public function makeOrder(Request $request){
        $user=auth()->user();
        $cartitems=$user->cart;
        if(!$cartitems){
            return response()->json([
                'message'=>'Cart is empty',
                'errors'=>[

                ],
            ], 200);
        }
        $order=new Order(['refid'=>date('YmdHis')]);
        $user->orders()->save($order);

        $total=0;
        foreach($cartitems as $item){
            if($item->entity instanceof PartnerEvent) {
                $total = ($item->men + $item->women + 2*$item->couple) * $item->entity->packages->first()->price;
                $item=new OrderItem([
                    'entity_id'=>$item->entity_id,
                    'entity_type'=>$item->entity_type,
                    'other_id'=>$item->other_id,
                    'men'=>$item->men,
                    'women'=>$item->women,
                    'couple'=>$item->couple
                ]);
                $order->details()->save($item);
            }
        }

        $order->total=$total;
        if($order->save()){
            return response()->json([
                'message'=>'success',
                'errors'=>[

                ],
            ], 200);

        }
        return response()->json([
            'message'=>'some error occurred',
            'errors'=>[

            ],
        ], 404);


    }
}
