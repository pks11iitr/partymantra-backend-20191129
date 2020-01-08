<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Partner;
use App\Models\PartnerEvent;
use App\Models\Review;
use App\Services\Payment\RazorPayService;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /*
     * keep latest order in cart
     * on next order
     */
    public function __construct(RazorPayService $pay){
        $this->pay=$pay;
    }

    public function addtocart(Request $request){
        $request->validate([
            'type'=>'required|in:event',
            'itemid'=>'required|array',
            'itemid.*'=>'required|integer',
            'pass'=>'required|array',
            'pass.*'=>'required|integer|min:1',
            'men'=>'required|integer|min:0',
            'women'=>'required|integer|min:0',
            'couple'=>'required|integer|min:0',
            'name'=>'required|string|max:50',
            'mobile'=>'required|integer|digits:10',
            'email'=>'required|email'
        ]);

        //clear previous cart
        auth()->user()->cart()->delete();

        switch($request->type){
            case 'event': return $this->addEventToCart($request);
        }

    }

    private function addEventToCart(Request $request){

        $packages=Package::with('event')->whereIn('id', $request->itemid)->get();
        $cartitems=[];
        $cartpackages=[];
        $amount=0;
        $i=0;
        $eventids=[];
        foreach($packages as $package){
            if(!in_array($package->event->id, $eventids))
                $eventids[]=$package->event->id;
            $cartitems[]=[
                'entity_type'=>'App\Models\PartnerEvent',
                'entity_id'=>$package->event_id,
                'other_id'=>$package->id,
                'men'=>$request->men,
                'women'=>$request->women,
                'couple'=>$request->couple,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'name'=>$request->name,
                'partner_id'=>$package->partner_id,
                'user_id'=>auth()->user()->id,
                'no_of_pass'=>$request->pass[$i],
            ];

            $cartpackages[]=[
                'package'=>$package->title,
                'pass'=>$request->pass[$i],
                'price'=>$package->price,
                'package_type'=>$package->package_type
            ];
            $title=$package->event->title;
            $date=$package->event->startdate.'-'.$package->event->enddate;
            $address=$package->event->venue_address;
            $image=$package->event->small_image;
            $amount=$amount+$request->pass[$i]*$package->price;
            $i++;
        }

        //var_dump($cartitems);die;
        //var_dump($eventids);die;
        if(!empty($cartitems) && count($eventids)==1){
            if(Cart::insert($cartitems)){
                return [
                    'message'=>'success',
                    'data'=>[
                        'title'=>$title,
                        'image'=>$image,
                        'address'=>$address,
                        'packages'=>$cartpackages,
                        'date'=>$date,
                        'totalpass'=>array_sum($request->pass),
                        'name'=>$request->name,
                        'mobile'=>$request->mobile,
                        'email'=>$request->email,
                        'ratio'=>'Men: '.$request->men.' Women: '.$request->women.' Couple:'.$request->couple,
                        'amount'=>$amount,
                        'taxes'=>0,
                    ]
                ];
            }
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
        $items=[];
        foreach($cartitems as $item){
            if($item->entity instanceof PartnerEvent) {

                $items[]=new OrderItem([
                    'entity_id'=>$item->entity_id,
                    'entity_type'=>$item->entity_type,
                    'other_id'=>$item->other_id,
                    'partner_id'=>$item->partner_id,
                    'no_of_pass'=>$item->no_of_pass,
                    'price'=>$item->package->price,
                ]);

                $total = $total+$item->no_of_pass*$item->package->price;
                $email=$item->email;
                $mobile=$item->mobile;
                $name=$item->name;
                $men=$item->men;
                $women=$item->women;
                $couple=$item->couple;
            }
        }
        if(!count($items)){
            return response()->json([
                'message'=>'some error occurred',
                'errors'=>[

                ],
            ], 404);
        }
        $order->details()->saveMany($items);
        $order->total=$total;
        $order->email=$email;
        $order->mobile=$mobile;
        $order->name=$name;
        $order->men=$men;
        $order->women=$women;
        $order->couple=$couple;
        if($order->save()){
            auth()->user()->cart()->delete();
            $response=$this->pay->generateorderid([
                "amount"=>$order->total,
                "currency"=>"INR",
                "receipt"=>$order->refid,
            ]);
            $responsearr=json_decode($response);
            if(isset($responsearr->id)){
                $order->order_id=$responsearr->id;
                $order->order_id_response=$response;
                $order->save();
                return response()->json([
                    'status'=>'success',
                    'message'=>'success',
                    'data'=>[
                        'orderid'=> $order->order_id,
                        'total'=>$order->total,
                        'email'=>$email,
                        'mobile'=>$mobile,
                        'description'=>$item->entity->title,
                        'address' => '',
                        'name'=>$name,
                        'currency'=>'INR',
                        'merchantid'=>$this->pay->merchantkey,
                    ],
                ], 200);
            }else{
                return response()->json([
                    'status'=>'failed',
                    'message'=>'Payment cannot be initiated',
                    'data'=>[
                    ],
                ], 200);
            }
        }
        return response()->json([
            'message'=>'some error occurred',
            'errors'=>[

            ],
        ], 404);


    }

    private function payExistingOrder(Request $request, $id){
        $user=auth()->user();
        $order=Order::with(['details.entity', 'details.package'])->where('user_id', auth()->user()->id)->where('refid', $id)->where('payment_status', 'pending')->firstOrFail();

        $amount=0;
        foreach($order->details as $item){
            $amount=$amount+$item->no_of_pass*$item->package->price;
        }

        $order->total=$amount;
        $order->save();

        if($order->details[0]->entity instanceof PartnerEvent) {
            return response()->json([
                'message' => 'success',
                'data' => [
                    'orderid' => $order->order_id,
                    'total' => $amount,
                    'email' => $order->email,
                    'mobile' => $order->mobile,
                    'description' => $order->details[0]->entity->title,
                    'address' => '',
                    'name'=>$order->name,
                    'currency'=>'INR',
                    'merchantid'=>$this->pay->merchantkey,

                ],
            ], 200);
        }
        return response()->json([
            'message'=>'some error occurred',
            'errors'=>[

            ],
        ], 404);
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
        $cart=$user->cart()->with(['entity', 'package'])->get();
        $cartpackages=[];
        $amount=0;
        $totalpass=0;
        if(count($user->cart)){
            foreach($cart as $c){
                //$package=$c->package;
                $cartpackages[]=[
                    'package'=>$c->package->package_name,
                    'pass'=>$c->no_of_pass,
                    'price'=>$c->package->price,
                    'package_type'=>$c->package->package_type
                ];
                $title=$c->entity->title;
                $date=$c->entity->startdate.'-'.$c->entity->enddate;
                $amount=$amount+$c->no_of_pass*$c->package->price;
                $totalpass=$totalpass+$c->no_of_pass;
                $address=$c->entity->venue_address;
                $image=$c->entity->small_image;
            }
            return [
                'message'=>'success',
                'data'=>[
                    'title'=>$title,
                    'image'=>$image,
                    'address'=>$address,
                    'packages'=>$cartpackages,
                    'totalpass'=>$totalpass,
                    'name'=>$c->name,
                    'mobile'=>$c->mobile,
                    'email'=>$c->email,
                    'date'=>$date,
                    'time_to_start'=>'very soon',
                    'ratio'=>'Men: '.$c->men.' Women: '.$c->women.' Couple:'.$c->couple,
                    'amount'=>$amount,
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
        $order=Order::with(['details.package', 'details.entity'])->where('user_id', $user->id)->where('refid', $id)->firstOrFail();
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
            if($order->payment_status=='pending'){
                $amount=$amount+$c->no_of_pass*$c->package->price;
            }else{
                $amount=$amount+$c->no_of_pass*$c->price;
            }
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

    public function verifyPayment(Request $request){
        $order=Order::where('order_id', $request->razorpay_order_id)->firstOrFail();
        $paymentresult=$this->pay->verifypayment($request->all());
        if($paymentresult){
            $order->payment_id=$request->razorpay_payment_id;
            $order->payment_id_response=$request->razorpay_signature;
            $order->payment_status='paid';
            $order->save();
            return response()->json([
                'status'=>'success',
                'message'=>'Payment is successfull',
                'errors'=>[

                ],
            ], 200);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Payment is not successfull',
                'errors'=>[

                ],
            ], 200);
        }
    }

}
