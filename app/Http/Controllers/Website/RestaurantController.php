<?php

namespace App\Http\Controllers\Website;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    public function view(Request $request, $id){
        $restaurant=Partner::active()->with(['avgreviews', 'facilities', 'menus','eventparty','reviews'])->with(['gallery'=>function($gallery){
            $gallery->whereIn('other_type', ['restaurant', 'both']);
        }])->with(['packages'=>function($package){
            $package->where('isactive', true)->where('partneractive', true)->where('fordining', true)->where('package_type', 'other')->with('activemenus');
        }])->findOrFail($id);
        if(!$restaurant){
            return response()->json([
                'message'=>'invalid request',
                'errors'=>[

                ],
            ], 404);
        }
        //$event->time_to_start='very soon';
        //echo '<pre>';
        //var_dump($restaurant);die;
        $data=[];
        $requestdata=$request->session()->get('requestdata');
        $cartdata=[];
        if(isset($requestdata))
            $cartdata=json_decode($request->session()->get('requestdata'),true)['cartdata']??[];
        //echo "<pre>";
        //print_r($cartdata);die;
        return view('Website.restaurant-details', compact('restaurant','cartdata'));
    }

    public function partyview(Request $request, $id){
        $restaurant=Partner::active()->with(['avgreviews', 'facilities'])->with(['packages'=>function($package){
            $package->where('isactive', true)->where('partneractive', true)->where('forparty', true)->where('package_type', 'other')->with('activemenus');
        }])->findOrFail($id);
        if(!$restaurant){
            return response()->json([
                'message'=>'invalid request',
                'errors'=>[

                ],
            ], 404);
        }
        //$event->time_to_start='very soon';

        return ['party'=>$restaurant];
    }

    public function gallery(Request $request, $id){
        $product=Partner::findOrFail($id);
        return $product->gallery->where('isactive', true)->whereIn('other_type', ['restaurant', 'both']);
    }

    public function partygallery(Request $request, $id){
        $product=Partner::findOrFail($id);
        return $product->gallery->where('isactive', true)->whereIn('other_type', ['party', 'both']);
    }

    public function reviews(Request $request, $id){
        $product=Partner::findOrFail($id);
        return $product->reviews()->with(array('user'=>function($query){
            $query->select('id','name','image');
        }))->where('isactive', true)->get();
    }
}
