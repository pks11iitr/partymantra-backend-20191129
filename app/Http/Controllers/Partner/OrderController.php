<?php

namespace App\Http\Controllers\Partner;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders=Order::with('details')->orderBy('updated_at','desc')->paginate(20);
        //var_dump($orders);
        return view('partneradmin.orders.index', compact('orders'));
    }
}
