<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Partner;
use App\Models\PartnerEvent;
use App\Models\Review;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
            'partner_id'=>$package->partner_id

        ])){
            return [
                'message'=>'success',
                'data'=>[
                    'title'=>$package->event->title,
                    'package'=>$package->title,
                    'image'=>$package->event->small_image,
                    'date'=>$package->event->startdate.'-'.$package->event->enddate,
                    'totalpass'=>$cart->men+$cart->women+$cart->couple,
                    'name'=>$cart->name,
                    'mobile'=>$cart->mobile,
                    'email'=>$cart->email,
                    'ratio'=>'Men: '.$cart->men.' Women: '.$cart->women.' Couple:'.$cart->couple,
                    'amount'=>($cart->men+$cart->women+$cart->couple)*$package->price,
                    'taxes'=>0,
                ]
            ];
        }
        return response()->json([
            'message'=>'some error occurred',
            'errors'=>[

            ],
        ], 404);

    }

    public function makeOrder(Request $request, $id=null){
        $user=auth()->user();
        if(!empty($id)){
            return $this->payExistingOrder($request, $id);
        }
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
                    'couple'=>$item->couple,
                    'partner_id'=>$item->partner_id
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

    private function payExistingOrder(Request $request, $id){
        $order=Order::where('user_id', auth()->user()->id)->where('refid', $id)->where('status', 'pending')->firstOrFail();
    }

    public function history(Request $request){
        $user=auth()->user();
        //var_dump($user->id);die;
        $orders=Order::where('user_id', $user->id)->get();
        $ordersdetail=[];
        $i=0;
        foreach($orders as $o){
            $ordersdetail[$i]=$o->toArray();
            foreach($o->details as $d){
                $ordersdetail[$i]['title']=$d->entity->title;
                $ordersdetail[$i]['image']=$d->entity->small_image;
            }
        }

        return $ordersdetail;
    }

    public function cartdetails(Request $request){
        $user=auth()->user();

        if(count($user->cart)){
            foreach($user->cart as $d){
                $product=$d->entity;
                $detail=$d;
            }
            //print_r($detail);die;
            $package=Package::findOrFail($detail->other_id);
            return [
                'message'=>'success',
                'data'=>[
                    'title'=>$product->title,
                    'package'=>$package->package_name,
                    'image'=>$product->small_image,
                    'date'=>$product->startdate.'-'.$product->enddate,
                    'price'=>$package->price,
                    'totalpass'=>$detail->men+$detail->women+$detail->couple,
                    'name'=>$detail->name,
                    'mobile'=>$detail->mobile,
                    'email'=>$detail->email,
                    'time_to_start'=>'very soon',
                    'ratio'=>'Men: '.$detail->men.' Women: '.$detail->women.' Couple:'.$detail->couple,
                    'amount'=>($detail->men+$detail->women+$detail->couple)*$package->price,
                    'taxes'=>0,
                ]
            ];
        }else{
            return [
                'message'=>'success',
                'data'=>[

                ]
            ];
        }


    }
    public function details(Request $request, $id){
        $user=auth()->user();
        $order=Order::where('user_id', $user->id)->where('refid', $id)->firstOrFail();
        $details=$order->details;

        foreach($details as $d){
            $product=$d->entity;
            $detail=$d;
        }
        //print_r($detail);die;
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
                'qrcode'=>route('api.order.qr', ['id'=>$order->id])
            ]
        ];

    }

    public function getQRcode(Request $request, $id){
        $order=Order::findOrFail($id);
        return QrCode::size(100)->generate($order->refid);
    }

    public function review(Request $request, $id){
        $user=auth()->user();
        $request->validate([
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string|max:200'
        ]);
        $order=Order::with('details')->where('user_id', $user->id)->where('payment_status', 'paid')->findOrFail($id);

        if($order->review)
            return response()->json([
                'message'=>'You have already reviewed this order',
                'errors'=>[

                ],
            ], 200);
        foreach($order->details as $d){
            $product=$d->entity;
        }
        $review=new Review([
            'user_id'=>$user->id,
            'description'=>$request->comment,
            'rating'=>$request->rating,
            'order_id'=>$id
        ]);
        if($product->reviews()->save($review)){
            return response()->json([
                'message'=>'Review has been submitted successfully',
                'errors'=>[

                ],
            ], 200);
        }else{
            return response()->json([
                'message'=>'some error occurred',
                'errors'=>[

                ],
            ], 404);
        }
    }


}
