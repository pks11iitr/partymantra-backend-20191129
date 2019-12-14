<?php

namespace App\Http\Controllers\Admin;

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
       $partnersactive=Partner::active()->count();
       $partnerstotal=Partner::count();
       $eventsactive=PartnerEvent::active()->count();
       $eventstotal=PartnerEvent::count();
       $customers=User::doesnthave('partner')->count();
       $orders=Order::where('payment_status', 'paid')->count();

       $ordersstat=DB::table('orders')
                        ->select(DB::raw('count(*) as c'), DB::raw('DATE(updated_at) as date'))
                        ->groupBy(DB::raw('DATE(updated_at)'))
                        ->get();
       return view('siteadmin.dashboard', compact('partnersactive','partnerstotal','eventsactive','eventstotal','customers','orders','ordersstat'));
    }
}
