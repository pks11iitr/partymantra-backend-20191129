<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders=Order::with(['details.entity', 'details.entity.partner', 'customer'])->orderBy('updated_at','desc')->paginate(20);
        //var_dump($orders);
        return view('siteadmin.orders.index', compact('orders'));
    }

    public function details(Request $request, $id){
        $order=Order::with(['details.entity', 'details.entity.partner', 'customer'])->where('id', $id)->firstOrFail();
        //var_dump($orders);
        return view('siteadmin.orders.details', compact('order'));
    }
}
