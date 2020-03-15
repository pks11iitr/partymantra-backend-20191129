<?php

namespace App\Http\Controllers\Website;

use App\Events\OrderSuccessfull;
use App\Http\Controllers\Website\Traits\WebsiteLoginRedirection;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Partner;
use App\Models\PartnerEvent;
use App\Models\Review;
use App\Models\Wallet;
use App\Services\Payment\RazorPayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    use WebsiteLoginRedirection;

    public function __construct(RazorPayService $pay)
    {
        $this->pay=$pay;
    }

    public function addtocart(Request $request, RazorPayService $pay){
        $request->validate([
            'type'=>'required|in:event,restaurant,party',
        ]);
        //return $request->all();
        $redirect=$this->redirectIfRequired(url()->previous(), ['cartdata'=>$request->all()]);
        if($redirect)
            return $redirect;
        //echo "<pre>";
        //print_r($request->all());die;
        //clear previous cart
        auth()->user()->cart()->delete();

        switch($request->type){
            case 'event': return $this->addEventToCart($request);
            case 'restaurant': return $this->addDiningToCart($request);
            case 'party': return $this->addPartyToCart($request);
        }

    }

    private function addEventToCart(Request $request){
        $request->validate([
            'itemid'=>'required|array',
            'itemid.*'=>'required|integer',
            'pass'=>'required|array',
            'pass.*'=>'required|integer|min:1',
            'name'=>'required|string|max:50',
            'mobile'=>'required|string|digits:10',
            'email'=>'required|email'
        ], ['pass.*'=>'Please select a package']);

        $cartitems=[];
        $cartpackages=[];
        $amount=0;
        $i=0;
        $items=[];
        $eventids=[];

        $maps=[];
        foreach($request->itemid as $key=>$val){
            if($request->pass[$key]>0){
                $items[]=$val;
                $maps[$val]=$request->pass[$key];
            }
        }

        $packages=Package::with('event')->whereIn('id', $items)->get();

        foreach($packages as $package){
            if(!in_array($package->event->id, $eventids))
                $eventids[]=$package->event->id;
            $cartitems[]=[
                'entity_type'=>'App\Models\PartnerEvent',
                'entity_id'=>$package->event_id,
                'other_type'=>'App\Models\Package',
                'other_id'=>$package->id,
                'men'=>$request->men??0,
                'women'=>$request->women??0,
                'couple'=>$request->couple??0,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'name'=>$request->name,
                'partner_id'=>$package->partner_id,
                'user_id'=>auth()->user()->id,
                'no_of_pass'=>$maps[$package->id],
            ];

            $cartpackages[]=[
                'package'=>$package->package_name,
                'pass'=>$request->pass[$i],
                'price'=>$package->price,
                'package_type'=>$package->package_type
            ];
            $i++;
        }


        if(!empty($cartitems) && count($eventids)==1){
            if(Cart::insert($cartitems)){
                return redirect()->route('website.cart.details');
            }
        }

        return redirect()->back()->with('error', 'Some error occured');

    }

    private function addDiningToCart(Request $request){
        $request->validate([
            'entity_id'=>'required|integer',
            'itemid'=>'array',
            'itemid.*'=>'required|integer',
            'pass'=>'array',
            'pass.*'=>'required|integer|min:1',
            'menuid'=>'array',
            'menuid.*'=>'required|integer',
            'quantity'=>'array',
            'quantity.*'=>'required|integer|min:1',
            'men'=>'required|integer|min:0',
            'women'=>'required|integer|min:0',
            'couple'=>'required|integer|min:0',
            'name'=>'required|string|max:50',
            'mobile'=>'required|string|digits:10',
            'email'=>'required|email',
            'date'=>'required|date_format:Y-m-d',
            'time'=>'required|date_format:h:iA'
        ]);
        $cartitems=[];
        $cartpackages=[];
        $amount=0;

        // select packages from inputs

        $partner=Partner::with(['packages'=>function($packages)use($request){
            $packages->whereIn('event_packages.id', $request->itemid??[])->where('fordining', true)->where('package_type', 'other');
        }, 'menus'=>function($menus)use($request){
            $menus->whereIn('menus.id', $request->menuid??[]);
        }])->findOrFail($request->entity_id);

        if(!empty($request->itemid) ){
            $maps=[];
            foreach($request->itemid as $key=>$val){
                $maps[$val]=$request->pass[$key];
            }
            $i = 0;
            foreach ($partner->packages as $package) {
                $cartitems[] = [
                    'entity_type' => 'App\Models\Partner',
                    'entity_id' => $package->partner_id,
                    'optional_type' => 'dining',
                    'other_id' => $package->id,
                    'other_type' => 'App\Models\Package',
                    'men' => $request->men,
                    'women' => $request->women,
                    'couple' => $request->couple,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'name' => $request->name,
                    'partner_id' => $partner->id,
                    'user_id' => auth()->user()->id,
                    'no_of_pass' => $maps[$package->id],
                    'date'=>$request->date,
                    'time'=>$request->time
                ];

                $cartpackages[] = [
                    'name' => $package->package_name,
                    'quantity' => $request->pass[$i],
                    'price' => $package->price,
                    'package_type' => 'package'
                ];
                $amount = $amount + $request->pass[$i] * $package->price;
                $i++;
            }
        }

        //select menus from inputs
        if(!empty($request->menuid)){
            $menumaps=[];
            foreach($request->menuid as $key=>$val){
                $menumaps[$val]=$request->quantity[$key];
            }

            $i = 0;
            foreach($partner->menus as $menu){

                $cartitems[]=[
                    'entity_type'=>'App\Models\Partner',
                    'entity_id'=>$partner->id,
                    'other_id'=>$menu->id,
                    'optional_type' => 'dining',
                    'other_type'=>'App\Models\Menu',
                    'men'=>$request->men,
                    'women'=>$request->women,
                    'couple'=>$request->couple,
                    'email'=>$request->email,
                    'mobile'=>$request->mobile,
                    'name'=>$request->name,
                    'partner_id'=>$partner->id,
                    'user_id'=>auth()->user()->id,
                    'no_of_pass'=>$menumaps[$menu->id],
                    'date'=>$request->date,
                    'time'=>$request->time
                ];

                $cartpackages[]=[
                    'package'=>$menu->name,
                    'pass'=>$request->quantity[$i],
                    'price'=>$menu->pivot->price,
                    'package_type'=>'menu'
                ];

                $amount=$amount+$request->quantity[$i]*$menu->pivot->price;
                $i++;
            }

        }
        //echo "<pre>";
        //var_dump($cartitems);die;


        if(!empty($cartitems)){
            $title=$partner->name.' (Dining)';
            $date=$cartitems[0]['date'].' '.$cartitems[0]['time'];
            $address=$partner->adderss;
            $image=$partner->small_image;

            if(Cart::insert($cartitems)){
                return redirect()->route('website.cart.details');
            }
        }else{
            $title=$partner->name.' (Dining)';
            $date=$request->date.' '.$request->time;
            $address=$partner->adderss;
            $image=$partner->small_image;

            $cartitems[]=[
                'entity_type'=>'App\Models\Partner',
                'entity_id'=>$partner->id,
                'optional_type' => 'dining',
                'men'=>$request->men,
                'women'=>$request->women,
                'couple'=>$request->couple,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'name'=>$request->name,
                'partner_id'=>$partner->id,
                'user_id'=>auth()->user()->id,
                'no_of_pass'=>0,
                'date'=>$request->date,
                'time'=>$request->time
            ];
            //var_dump($cartitems);die;
            if(Cart::insert($cartitems)){
                return redirect()->route('website.cart.details');
            }
        }

        return redirect()->back()->with('error', 'Some error occured');

    }

    public function addPartyToCart(Request $request){
        $request->validate([
            'entity_id'=>'required|integer',
            'itemid'=>'array',
            'itemid.*'=>'required|integer',
            'pass'=>'array',
            'pass.*'=>'required|integer|min:1',
            'men'=>'required|integer|min:0',
            'women'=>'required|integer|min:0',
            'couple'=>'required|integer|min:0',
            'name'=>'required|string|max:50',
            'mobile'=>'required|string|digits:10',
            'email'=>'required|email',
            'date'=>'required|date_format:Y-m-d',
            'time'=>'required|string|max:20'
        ]);
        $cartitems=[];
        $cartpackages=[];
        $amount=0;

        // select packages from inputs

        $partner=Partner::where('allow_party', true)->with(['packages'=>function($packages)use($request){
            $packages->whereIn('event_packages.id', $request->itemid??[])->where('forparty', true)->where('package_type', 'other');
        }])->findOrFail($request->entity_id);

        if(!empty($request->itemid) ){
            $maps=[];
            foreach($request->itemid as $key=>$val){
                $maps[$val]=$request->pass[$key];
            }

            $i = 0;
            foreach ($partner->packages as $package) {
                $cartitems[] = [
                    'entity_type' => 'App\Models\Partner',
                    'entity_id' => $partner->id,
                    'optional_type' => 'party',
                    'other_id' => $package->id,
                    'other_type' => 'App\Models\Package',
                    'men' => $request->men,
                    'women' => $request->women,
                    'couple' => $request->couple,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'name' => $request->name,
                    'partner_id' => $partner->id,
                    'user_id' => auth()->user()->id,
                    'no_of_pass' => $maps[$package->id],
                    'date'=>$request->date,
                    'time'=>$request->time
                ];

                $cartpackages[] = [
                    'name' => $package->package_name,
                    'quantity' => $request->pass[$i],
                    'price' => $package->price,
                    'package_type' => 'package'
                ];
                $amount = $amount + $request->pass[$i] * $package->price;
                $i++;
            }
        }

        if(!empty($cartitems)){
            $title=$partner->name.' (Party)';
            $date=$request->date.' '.$request->time;
            $address=$partner->adderss;
            $image=$partner->small_image;

            if(Cart::insert($cartitems)){
                return redirect()->route('website.cart.details');
            }
        }else{
            $title=$partner->name.' (Party)';
            $date=$request->date.' '.$request->time;
            $address=$partner->adderss;
            $image=$partner->small_image;

            $cartitems[] = [
                'entity_type' => 'App\Models\Partner',
                'entity_id' => $partner->id,
                'optional_type' => 'party',
                'men' => $request->men,
                'women' => $request->women,
                'couple' => $request->couple,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'name' => $request->name,
                'partner_id' => $partner->id,
                'user_id' => auth()->user()->id,
                'no_of_pass' => 0,
                'date'=>$request->date,
                'time'=>$request->time
            ];

            if(Cart::insert($cartitems)){
                return redirect()->route('website.cart.details');
            }
        }

        return redirect()->back()->with('error', 'Some error occured');

    }


    public function cartdetails(Request $request){

        $redirect=$this->redirectIfRequired(url()->full());
        if($redirect)
            return $redirect;

        $user=auth()->user();
        $cart=$user->cart()->with(['entity', 'other'])->get();
        $cartpackages=[];
        $amount=0;
        $totalpass=0;
        $menus=null;
        $data=[];
        if(count($user->cart)){
            foreach($cart as $c){
                if(!empty($c->other)){
                    if($c->other instanceof Package) {

                        $cartpackages[] = [
                            'package' => $c->other->package_name ?? $c->other->name,
                            'pass' => $c->no_of_pass,
                            'price' => $c->other->price,
                            'package_type' => $c->other->package_type ?? 'menu'
                        ];

                        $amount = $amount + $c->no_of_pass * $c->other->price;
                        $totalpass = $totalpass + $c->no_of_pass;

                    }else{
                        if(!$menus){
                            $menus=Menu::with('partner')->whereHas('partner',   function($partner) use($c){
                                $partner->where('partners.id', $c->partner_id);
                            })->get();
                            //return $menus;
                            $menuarr=[];
                            foreach($menus as $menu){
                                $menuarr[$menu->id]=$menu->partner[0]->pivot->price??0;
                            }
                        }

                        $cartpackages[] = [
                            'package' => $c->other->package_name ?? $c->other->name,
                            'pass' => $c->no_of_pass,
                            'price' => $menuarr[$c->other_id]??0,
                            'package_type' => $c->other->package_type ?? 'menu'
                        ];

                        $amount = $amount + $c->no_of_pass * $c->other->price;
                        $totalpass = $totalpass + $c->no_of_pass;

                    }
                }else{
                    $amount = 0;
                    $totalpass = 0;
                }


            }
            $title=$cart[0]->entity->title??($cart[0]->entity->name.' ('.$cart[0]->optional_type.')');
            if($cart[0]->entity instanceof Partner){
                $date=$cart[0]->date.' '.$cart[0]->time;
                $startdate=date('D,M d, Y', strtotime($cart[0]->date));
                $enddate=$cart[0]->time;
                $type=$cart[0]->optional_type;

            }else{
                $date=$cart[0]->entity->startdate.'-'.$cart[0]->entity->enddate;
                $startdate=date('D,M d, Y - H:iA', strtotime($cart[0]->entity->startdate));
                $enddate=date('D,M d, Y - H:iA', strtotime($cart[0]->entity->enddate));
                $type='event';
            }
            $address=$cart[0]->entity->venue_adderss??$cart[0]->entity->address;
            $image=$cart[0]->entity->small_image;
                $data=[
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
                    'subtotal'=>$amount,
                    'amount'=>$amount,
                    'taxes'=>0,
                    'startdate'=>$startdate,
                    'enddate'=>$enddate,
                    'walletbalance'=>Wallet::balance($user->id),
                    'type'=>$type
                ];

        }
//        echo "<pre>";
//        var_dump($data);die;
        return view('Website.cart-details', compact('data'));
    }

    public function makeOrder(Request $request, $id=null){
        $user=auth()->user();

        $redirect=$this->redirectIfRequired(url()->full());
        if($redirect)
            return $redirect;


        if(!empty($id)){
            return $this->payExistingOrder($request, $id);
        }

        $cartitems=$user->cart()->with(['other','entity'])->get();
        if(!$cartitems){
            return response()->json([
                'message'=>'Cart is empty',
                'errors'=>[

                ],
            ], 200);
        }

        //delete all pending orders and items
        OrderItem::whereHas('order', function($order)use($user){
            $order->where('payment_status', 'pending')->where('user_id', $user->id);
        })->delete();
        Order::where('payment_status', 'pending')->where('user_id', $user->id)->delete();



        $order=new Order(['refid'=>date('YmdHis'), 'usingwallet'=>($request->usingwallet==1?true:false)]);
        $user->orders()->save($order);

        $total=0;
        $items=[];
        $menus=null;
        foreach($cartitems as $item){

            if($item->entity instanceof PartnerEvent) {
                $items[]=new OrderItem([
                    'entity_id'=>$item->entity_id,
                    'entity_type'=>$item->entity_type,
                    'optional_type'=>$item->optional_type,
                    'other_type'=>$item->other_type,
                    'other_id'=>$item->other_id,
                    'partner_id'=>$item->partner_id,
                    'no_of_pass'=>$item->no_of_pass,
                    'price'=>$item->other->price,
                ]);
                $total = $total+$item->no_of_pass*$item->other->price;
            }elseif($item->entity instanceof Partner) {
                if (!empty($item->other)){
                    if ($item->other instanceof Menu) {

                        if (!$menus) {
                            $menus = Menu::with('partner')->whereHas('partner', function ($partner) use ($item) {
                                $partner->where('partners.id', $item->partner_id);
                            })->get();
                            //return $menus;
                            $menuarr = [];
                            foreach ($menus as $menu) {
                                $menuarr[$menu->id] = $menu->partner[0]->pivot->price ?? 0;
                            }
                        }

                        $items[] = new OrderItem([
                            'entity_id' => $item->entity_id,
                            'entity_type' => $item->entity_type,
                            'optional_type' => $item->optional_type,
                            'other_type' => $item->other_type,
                            'other_id' => $item->other_id,
                            'partner_id' => $item->partner_id,
                            'no_of_pass' => $item->no_of_pass,
                            'price' => $menuarr[$item->other_id] ?? 0,
                        ]);
                        $total = $total + $item->no_of_pass * ($menuarr[$item->other_id] ?? 0);
                    } else {
                        $items[] = new OrderItem([
                            'entity_id' => $item->entity_id,
                            'entity_type' => $item->entity_type,
                            'optional_type' => $item->optional_type,
                            'other_type' => $item->other_type,
                            'other_id' => $item->other_id,
                            'partner_id' => $item->partner_id,
                            'no_of_pass' => $item->no_of_pass,
                            'price' => $item->other->price,
                        ]);
                        $total = $total + $item->no_of_pass * $item->other->price;
                    }
                }else{
                    $items[] = new OrderItem([
                        'entity_id' => $item->entity_id,
                        'entity_type' => $item->entity_type,
                        'optional_type' => $item->optional_type,
                        'partner_id' => $item->partner_id,
                        'no_of_pass' => 0,
                        'price' => 0,
                    ]);
                    $total = $total+0;
                }


            }
        }
        if(!count($items)){
            return response()->json([
                'message'=>'some error occurred',
                'errors'=>[

                ],
            ], 404);
        }

        $email=$item->email;
        $mobile=$item->mobile;
        $name=$item->name;
        $men=$item->men;
        $women=$item->women;
        $couple=$item->couple;
        $date=$item->date;
        $time=$item->time;

        if($item->entity instanceof PartnerEvent){
            $description=$item->entity->title;
        }else{
            if($item->optional_type=='dining'){
                $description=$item->entity->name." (Dining)";
            }else{
                $description=$item->entity->name." (Party)";
            }
        }

        $order->details()->saveMany($items);
        if($total>0){
            if($request->usingwallet==1){
                $order->usingwallet=true;
                $walletbalance=Wallet::balance($user->id);
                $fromwallet=($total>=$walletbalance)?$walletbalance:$total;
            }
            else{
                $fromwallet=0;
            }
        }else{
            $fromwallet=0;
        }
        $order->total=$total;
        $order->fromwallet=$fromwallet;
        $order->email=$email;
        $order->mobile=$mobile;
        $order->name=$name;
        $order->men=$men;
        $order->women=$women;
        $order->couple=$couple;
        $order->date=$date;
        $order->time=$time;
        if($order->save()){
            $api_key=$this->pay->api_key;
            //auth()->user()->cart()->delete();
            if($total==0){
                $order->payment_status='paid';
                $order->save();
                event(new OrderSuccessfull($order));

                return redirect()->route('website.order.details', ['id'=>$order->refid])->with('success', 'Congratulations. Your order has been successfull');

            }else if($order->total-$fromwallet>0){
                $response=$this->pay->generateorderid([
                    "amount"=>$order->total*100-$fromwallet*100,
                    "currency"=>"INR",
                    "receipt"=>$order->refid,
                ]);
                $responsearr=json_decode($response);
                if(isset($responsearr->id)){
                    $order->order_id=$responsearr->id;
                    $order->order_id_response=$response;
                    $order->save();

                    $data=[
                        'orderid'=> $order->order_id,
                        'total'=>($order->total-$fromwallet)*100,
                        'email'=>$email,
                        'mobile'=>$mobile,
                        'description'=>$description,
                        'address' => '',
                        'name'=>$name,
                        'currency'=>'INR',
                        'merchantid'=>$this->pay->merchantkey,
                        'url'=>route('website.verify.payment')
                    ];

                    return view('Website.checkout', compact('data','api_key'));

                }else{
                    return redirect()->route('cart-details', ['id'=>$order->refid])->with('error', 'We apologize, Payment cannot be initialized this time');

                }
            }else{
                Wallet::updatewallet($user->id, 'Amount paid for Order ID:'.$order->refid, 'Debit', $order->total, $order->id);

                $order->payment_status='paid';
                $order->save();
                event(new OrderSuccessfull($order));
                return redirect()->route('website.order.details', ['id'=>$order->refid])->with('success', 'Congratulations. Your order has been successfull');
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
        $order=Order::with(['details.entity', 'details.other'])->where('user_id', auth()->user()->id)->where('refid', $id)->where('payment_status', 'pending')->firstOrFail();

        $amount=0;
        $menus=null;
        foreach($order->details as $item){
            if(!empty($item->other)){
                if($item->other instanceof Package){
                    $amount=$amount+$item->no_of_pass*$item->other->price;
                }else{
                    if(!$menus){
                        $menus=Menu::with('partner')->whereHas('partner',   function($partner) use($item){
                            $partner->where('partners.id', $item->partner_id);
                        })->get();
                        //return $menus;
                        $menuarr=[];
                        foreach($menus as $menu){
                            $menuarr[$menu->id]=$menu->partner[0]->pivot->price??0;
                        }
                    }
                    $amount=$amount+$item->no_of_pass*($menuarr[$item->other_id]??0);
                }
            }else{
                $amount=$amount+0;
            }
        }

        $order->total=$amount;
        $order->save();

        if($amount>0){
            if($request->usingwallet==1){
                $walletbalance=Wallet::balance($user->id);
                $fromwallet=($amount>=$walletbalance)?$walletbalance:$amount;
                $order->usingwallet=true;
                $order->fromwallet=$fromwallet;
                if($amount-$fromwallet>0){
                    $paymentdone='no';
                }else{
                    $order->payment_status='paid';
                    $paymentdone='yes';
                }
                $order->save();
            }else{
                $paymentdone='no';
                $fromwallet=0;
            }
        }else{
            $fromwallet=0;
            $paymentdone='yes';
            $order->payment_status='paid';
            $order->save();
        }

//        if($amount==0){
//            $paymentdone='yes';
//            $order->payment_status='paid';
//            $order->save();
//            //$amount=$amount;
//        }else if($amount-$fromwallet>0){
//            $paymentdone='no';
//            //$amount=$amount-$fromwallet;
//        }else{
//            $paymentdone='yes';
//            $order->payment_status='paid';
//            $order->save();
//            //$amount=$amount;
//        }
        if($order->details[0]->entity instanceof PartnerEvent) {
            return response()->json([
                'message' => 'success',
                'paymentdone'=>$paymentdone,
                'data' => [
                    'orderid' => $order->order_id,
                    'total' => ($amount-$fromwallet)*100,
                    'email' => $order->email,
                    'mobile' => $order->mobile,
                    'description' => $order->details[0]->entity->title,
                    'address' => '',
                    'name'=>$order->name,
                    'currency'=>'INR',
                    'merchantid'=>$this->pay->merchantkey,
                    'paymentdone'=>$paymentdone

                ],
            ], 200);
        }else{
            return response()->json([
                'message' => 'success',
                'paymentdone'=>$paymentdone,
                'data' => [
                    'orderid' => $order->order_id,
                    'total' => ($amount-$fromwallet)*100,
                    'email' => $order->email,
                    'mobile' => $order->mobile,
                    'description' => ($order->details[0]->entity->name??'').' ('.ucfirst($order->details[0]->optional_type??'').')',
                    'address' => '',
                    'name'=>$order->name,
                    'currency'=>'INR',
                    'merchantid'=>$this->pay->merchantkey,
                    'paymentdone'=>$paymentdone
                ],
            ], 200);
        }
        return response()->json([
            'message'=>'some error occurred',
            'errors'=>[

            ],
        ], 404);
    }

    public function verifyPayment(Request $request){
        $order=Order::where('order_id', $request->razorpay_order_id)->firstOrFail();
        Cart::where('user_id', $order->user_id)->delete();
        $paymentresult=$this->pay->verifypayment($request->all());
        if($paymentresult){
            $order->payment_id=$request->razorpay_payment_id;
            $order->payment_id_response=$request->razorpay_signature;
            $order->payment_status='paid';

            $order->save();
            if($order->usingwallet==true){
                $balance=Wallet::balance($order->user_id);
                if($balance < $order->fromwallet){
                    return redirect()->route('website.order.details', ['id'=>$order->id])->with('error', 'We apologize, Your order is not successfull');
                }
                Wallet::updatewallet($order->user_id, 'Amount paid for Order ID:'.$order->refid, 'Debit', $balance, $order->id);
            }
            event(new OrderSuccessfull($order));
            return redirect()->route('website.order.details', ['id'=>$order->refid])->with('success', 'Congratulations. Your order has been successfull');
        }else{
            return redirect()->route('website.order.details', ['id'=>$order->refid])->with('error', 'We apologize, Your order is not successfull');
        }
    }

    public function details(Request $request, $id){

        $redirect=$this->redirectIfRequired(url()->full());
        if($redirect)
            return $redirect;

        $user=auth()->user();
        $order=Order::with(['details.entity', 'details.other'])->where('user_id', $user->id)->where('refid', $id)->where('payment_status', '!=', 'pending')->firstOrFail();
        $amount=0;
        $totalpass=0;
        $cartpackages=[];

        if(!count($order->details))
            abort(404);

        $entity=$order->details[0]->entity;

        $menus=null;
        if($entity instanceof Partner && $order->payment_status=='pending'){
            if(!$menus){
                $menus=Menu::with('partner')->whereHas('partner',   function($partner) use($entity){
                    $partner->where('partners.id', $entity->id);
                })->get();
                //return $menus;
                $menuarr=[];
                foreach($menus as $menu){
                    $menuarr[$menu->id]=$menu->partner[0]->pivot->price??0;
                }
            }
        }

        foreach($order->details as $c){
            //$package=$c->package;
            if($c->optional_type=='billpay'){
                $amount=$c->price;
                $totalpass=0;
            }else{
                if(!empty($c->other)){
                    if($order->payment_status=='pending'){
                        if($c->other instanceof Package){
                            $cartpackages[]=[
                                'package'=>$c->other->package_name,
                                'pass'=>$c->no_of_pass,
                                'price'=>$c->other->price,
                                'package_type'=>$c->other->package_type
                            ];
                            $amount=$amount+$c->no_of_pass*$c->other->price;
                        }else{
                            $cartpackages[]=[
                                'package'=>$c->other->name,
                                'pass'=>$c->no_of_pass,
                                'price'=>$menuarr[$c->other->id]??0,
                                'package_type'=>'menu'
                            ];
                            $amount=$amount+$c->no_of_pass*($menuarr[$c->other->id]??0);
                        }

                    }else{
                        if($c->other instanceof Package){
                            $cartpackages[]=[
                                'package'=>$c->other->package_name,
                                'pass'=>$c->no_of_pass,
                                'price'=>$c->price,
                                'package_type'=>$c->other->package_type
                            ];
                        }else{
                            $cartpackages[]=[
                                'package'=>$c->other->name,
                                'pass'=>$c->no_of_pass,
                                'price'=>$c->price,
                                'package_type'=>'menu'
                            ];
                        }
                        $amount=$amount+$c->no_of_pass*$c->price;
                        $totalpass=$totalpass+$c->no_of_pass;
                    }
                }
            }
        }

        if($entity instanceof Partner) {
            $title = $c->entity->name.(" ($c->optional_type)");
            $date = date('D,d M Y', strtotime($order->date)).'-'.$order->time;
            $address = $c->entity->address;
            $image = $c->entity->small_image;
            $type='restaurant';
            $date=$order->details[0]->date.' '.$order->details[0]->time;
            $startdate=date('D,M d, Y', strtotime($order->details[0]->date));
            $enddate=$order->details[0]->time;
        }else{
            $title = $c->entity->title;
            $date = $c->entity->startdate . '-' . $c->entity->enddate;
            $address = $c->entity->venue_adderss;
            $image = $c->entity->small_image;
            $type='event';
            $startdate=date('D,M d, Y - H:iA', strtotime($order->details[0]->entity->startdate));
            $enddate=date('D,M d, Y - H:iA', strtotime($order->details[0]->entity->enddate));
        }

            $data=[
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
                'subtotal'=>$amount,
                'taxes'=>0,
                'type'=>$type,
                'startdate'=>$startdate,
                'enddate'=>$enddate
                //'qrcode'=>$order->payment_status=='paid'?route('api.order.qr', ['id'=>$order->id]):''
            ];

        return view('Website.order-details', compact('data'));
    }


    public function history(Request $request){

        $redirect=$this->redirectIfRequired(url()->full());
        if($redirect)
            return $redirect;

        $user=auth()->user();
        //var_dump($user->id);die;
        $orders=Order::with('details.entity')->where('user_id', $user->id)->whereIn('payment_status', [ 'paid','declined','cancel-request','cancelled', 'refunded'])->orderBy('id', 'desc')->get();
        $ordersdetail=[];
        $i=0;
        foreach($orders as $o){
            $ordersdetail[$i]=$o->toArray();
            foreach($o->details as $d){
                if($d->optional_type=='billpay') {
                    $ordersdetail[$i]['title'] = $d->partner->name. ('( ' . ($d->optional_type ?? '' ). ' )');
                    $ordersdetail[$i]['image'] = $d->partner->small_image;
                    $ordersdetail[$i]['ordertype']='billpay';
                    $ordersdetail[$i]['total']=$o->total+$o->instant_discount;
                    $ordersdetail[$i]['datetime']=date('D,m d,Y H:iA', strtotime($o->updated_at));
                    $ordersdetail[$i]['id']=$o->refid;
                    $ordersdetail[$i]['oid']=$o->id;
                }else{
                    if ($d->entity instanceof PartnerEvent) {
                        $ordersdetail[$i]['title'] = $d->entity->title;
                        $ordersdetail[$i]['ordertype']='event';
                    } else {
                        $ordersdetail[$i]['title'] = $d->entity->name . ('( ' . ($d->optional_type ?? '') . ' )');
                        $ordersdetail[$i]['ordertype']=$d->optional_type ?? '';
                    }
                    $ordersdetail[$i]['image'] = $d->entity->small_image;
                    $ordersdetail[$i]['total']=$o->total+$o->instant_discount;
                    $ordersdetail[$i]['datetime']=date('D,m d,Y H:iA', strtotime($o->updated_at));
                    $ordersdetail[$i]['id']=$o->refid;
                    $ordersdetail[$i]['oid']=$o->id;
                }
            }
            $i++;
        }
        return view('Website.profile', compact('ordersdetail','user'));
    }

    public function review(Request $request, $id){
        $user=auth()->user();
        $request->validate([
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string|max:200'
        ]);
        $order=Order::with('details.entity')->where('user_id', $user->id)->where('payment_status', 'paid')->findOrFail($id);

        if($order->review)
            return redirect()->back()->with('error', 'You have already reviewed this order');
        if(empty($order->details)){
            return redirect()->back()->with('error', 'No such order exists');
        }

        $product=$order->details[0]->entity;

        $review=new Review([
            'user_id'=>$user->id,
            'description'=>$request->comment,
            'rating'=>$request->rating,
            'order_id'=>$id
        ]);
        if($product->reviews()->save($review)){
            return redirect()->back()->with('success', 'Review has been submitted');
        }else{
            return redirect()->back()->with('error', 'Some error occured. Please try later');
        }
    }

    public function cancel(Request $request, $id){
        $request->validate([
            'reason_id'=>'required|integer',
            'reason_text'=>'string'
        ]);
        $user=auth()->user();
        $order=Order::where('payment_status', 'paid')->where('entry_marked', 0)->where('user_id', $user->id)->where('refid', $id)->first();
        if($order){
            $order->payment_status='cancel-request';
            $order->cancel_reason=$request->reason_id;
            $order->cancel_text=$request->reason_text;
            $order->save();
            return redirect()->back()->with('success', 'Your cancellation request has been raid. Our team will process your request.');
        }

        return redirect()->back()->with('error', 'This order cannot be cancelled now');

    }


}
