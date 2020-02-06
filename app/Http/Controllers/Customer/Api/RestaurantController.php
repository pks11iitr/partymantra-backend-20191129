<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Partner;
use App\Models\PartnerEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    public function view(Request $request, $id){
        $restaurant=Partner::active()->with(['avgreviews', 'facilities', 'menus','eventparty'])->with(['packages'=>function($package){
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
        return ['restaurant'=>$restaurant];
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
