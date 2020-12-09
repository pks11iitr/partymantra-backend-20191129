<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Partner;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request){
        $partners=Partner::get();
        if($request->datefrom){
            $datefrom=$request->datefrom;
        }else{
            $datefrom=date('Y-m-01');
        }
        if($request->dateto){
            $dateto=$request->dateto;
        }else{
            $dateto=date('Y-m-t');
        }
        if(empty($request->partner)){
            $partner=0;
            $orders=Order::with(['details.entity', 'details.partner', 'customer'])
                ->where('orders.updated_at','<=',$dateto)
                ->where('orders.updated_at','>=',$datefrom)
                ->orderBy('updated_at','desc')->paginate(20);
        }else{
            $partner=$request->partner;
            $orders=Order::with(['details.entity', 'details.partner', 'customer'])
                ->whereHas('details', function($details) use($partner){
                    $details->where('partner_id', $partner);
                })
                ->where('orders.updated_at','<=',$dateto)
                ->where('orders.updated_at','>=',$datefrom)
                ->orderBy('updated_at','desc')->paginate(20);
        }

        return view('siteadmin.orders.index', compact('orders','partners','dateto','datefrom','partner'));
    }

    public function details(Request $request, $id){
        $order=Order::with(['details.entity', 'details.other', 'details.partner', 'customer'])->where('id', $id)->firstOrFail();
        //var_dump($orders);
        return view('siteadmin.orders.details', compact('order'));
    }

    public function cancelapprove(Request $request, $id){

        $order=Order::where('payment_status', 'cancel-request')->where('id', $id)->first();
        $order->payment_status='cancelled';
        $order->save();

        Wallet::updatewallet($order->user_id, 'Amount refunded for Order ID:'.$order->refid, 'Credit', $order->total, $order->id);

        return redirect()->back()->with('success', 'Order cancel request has been approved');

    }

    public function paymenthistory(Request $request){
        if($request->datefrom){
            $datefrom=$request->datefrom;
        }else{
            $datefrom=date('Y-m-01');
        }
        if($request->dateto){
            $dateto=$request->dateto;
        }else{
            $dateto=date('Y-m-t');
        }

        $orders=Order::where('payment_status', 'paid')
                       ->where('orders.updated_at','<=',$dateto)
                       ->where('orders.updated_at','>=',$datefrom)
                       ->join(DB::raw("(select partner_id,order_id from order_details group by order_id,partner_id) partner_orders"),function($join){
                            $join->on('partner_orders.order_id','=','orders.id');
                        })
                        ->join('partners', 'partners.id', '=', 'partner_orders.partner_id')
                        ->select('partner_orders.partner_id', DB::raw('sum(orders.total) as total'),DB::raw('sum(orders.instant_discount) as instant_discount'), DB::raw('sum(orders.cashback_discount) as cashback_discount'),'partners.name','partners.id')
                        ->groupBy('partner_id')

            ->paginate(50);

        return view('siteadmin.payment-history',compact('orders','dateto','datefrom'));

    }
}
