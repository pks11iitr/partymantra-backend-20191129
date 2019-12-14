<?php

namespace App\Http\Controllers\Partner;

use App\Models\Order;
use App\Models\Partner;
use App\Models\PartnerEvent;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){

        $eventsactive=PartnerEvent::active()->where('partner_id', auth()->user()->partner->id)->count();
        $eventstotal=PartnerEvent::where('partner_id', auth()->user()->partner->id)->count();
        $orders=Order::with(['details'=>function($query){
           return $query->where('partner_id', auth()->user()->partner_id);
        }])->where('payment_status', 'paid')->count();

        $ordersstat=DB::table('orders')
            ->join('order_details', 'orders.id','=', 'order_details.order_id')
            ->where('order_details.partner_id', auth()->user()->partner->id)
            ->select(DB::raw('count(*) as c'), DB::raw('DATE(orders.updated_at) as date'))
            ->groupBy(DB::raw('DATE(orders.updated_at)'))
            ->get();
        return view('partneradmin.dashboard', compact('eventsactive','eventstotal' ,'orders','ordersstat'));
    }
}
