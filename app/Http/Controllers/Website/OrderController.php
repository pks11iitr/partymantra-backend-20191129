<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Package;
use App\Models\Partner;
use App\Models\Wallet;
use App\Services\Payment\RazorPayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function addtocart(Request $request, RazorPayService $pay){
        $request->validate([
            'type'=>'required|in:event,restaurant,party',
        ]);

        if(!auth()->user())
            return redirect()->back()->with('error', 'Please login to continue');

        return $request->all();
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
            'men'=>'required|integer|min:0',
            'women'=>'required|integer|min:0',
            'couple'=>'required|integer|min:0',
            'name'=>'required|string|max:50',
            'mobile'=>'required|integer|digits:10',
            'email'=>'required|email'
        ]);
        $packages=Package::with('event')->whereIn('id', $request->itemid)->get();
        $cartitems=[];
        $cartpackages=[];
        $amount=0;
        $i=0;
        $eventids=[];

        $maps=[];
        foreach($request->itemid as $key=>$val){
            $maps[$val]=$request->pass[$key];
        }
        foreach($packages as $package){
            if(!in_array($package->event->id, $eventids))
                $eventids[]=$package->event->id;
            $cartitems[]=[
                'entity_type'=>'App\Models\PartnerEvent',
                'entity_id'=>$package->event_id,
                'other_type'=>'App\Models\Package',
                'other_id'=>$package->id,
                'men'=>$request->men,
                'women'=>$request->women,
                'couple'=>$request->couple,
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

        //var_dump($cartitems);die;
        //var_dump($eventids);die;
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
            'mobile'=>'required|integer|digits:10',
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



        if(!empty($cartitems)){
            $title=$partner->name.' (Dining)';
            $date=$cartitems[0]['date'].' '.$cartitems[0]['time'];
            $address=$partner->adderss;
            $image=$partner->small_image;

            if(Cart::insert($cartitems)){
                return [
                    'message'=>'success',
                    'data'=>[
                        'title'=>$title,
                        'image'=>$image,
                        'address'=>$address,
                        'packages'=>$cartpackages,
                        'date'=>$date,
                        'totalitems'=>(!empty($request->pass)?array_sum($request->pass):0)+(!empty($request->quantity)?array_sum($request->quantity):0),
                        'name'=>$request->name,
                        'mobile'=>$request->mobile,
                        'email'=>$request->email,
                        'ratio'=>'Men: '.$request->men.' Women: '.$request->women.' Couple:'.$request->couple,
                        'subtotal'=>$amount,
                        'amount'=>$amount,
                        'taxes'=>0,
                        'walletbalance'=>Wallet::balance(auth()->user()->id)
                    ]
                ];
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
                return [
                    'message'=>'success',
                    'data'=>[
                        'title'=>$title,
                        'image'=>$image,
                        'address'=>$address,
                        'packages'=>[],
                        'date'=>$date,
                        'totalitems'=>0,
                        'name'=>$request->name,
                        'mobile'=>$request->mobile,
                        'email'=>$request->email,
                        'ratio'=>'Men: '.$request->men.' Women: '.$request->women.' Couple:'.$request->couple,
                        'subtotal'=>0,
                        'amount'=>0,
                        'taxes'=>0,
                        'walletbalance'=>Wallet::balance(auth()->user()->id)
                    ]
                ];
            }
        }

        return response()->json([
            'message'=>'some error occurred',
            'errors'=>[

            ],
        ]);

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
            'mobile'=>'required|integer|digits:10',
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
                return [
                    'message'=>'success',
                    'data'=>[
                        'title'=>$title,
                        'image'=>$image,
                        'address'=>$address,
                        'packages'=>[],
                        'date'=>$date,
                        'totalitems'=>0,
                        'name'=>$request->name,
                        'mobile'=>$request->mobile,
                        'email'=>$request->email,
                        'ratio'=>'Men: '.$request->men.' Women: '.$request->women.' Couple:'.$request->couple,
                        'subtotal'=>0,
                        'amount'=>0,
                        'taxes'=>0,
                        'walletbalance'=>Wallet::balance(auth()->user()->id)
                    ]
                ];
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
                return [
                    'message'=>'success',
                    'data'=>[
                        'title'=>$title,
                        'image'=>$image,
                        'address'=>$address,
                        'packages'=>[],
                        'date'=>$date,
                        'totalitems'=>0,
                        'name'=>$request->name,
                        'mobile'=>$request->mobile,
                        'email'=>$request->email,
                        'ratio'=>'Men: '.$request->men.' Women: '.$request->women.' Couple:'.$request->couple,
                        'subtotal'=>0,
                        'amount'=>0,
                        'taxes'=>0,
                        'walletbalance'=>Wallet::balance(auth()->user()->id)
                    ]
                ];
            }
        }

        return response()->json([
            'message'=>'some error occurred',
            'errors'=>[

            ],
        ]);

    }


    public function cartdetails(Request $request){
        $user=auth()->user();
        $cart=$user->cart()->with(['entity', 'other'])->get();
        $cartpackages=[];
        $amount=0;
        $totalpass=0;
        $menus=null;
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
            }else{
                $date=$cart[0]->entity->startdate.'-'.$cart[0]->entity->enddate;
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
                    'walletbalance'=>Wallet::balance($user->id)
                ];




        }else{
            return [
                'message'=>'success',
                'data'=>[

                ]
            ];
        }

        return view('Website.cart.details', compact('data'));
    }
}
