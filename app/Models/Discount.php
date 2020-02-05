<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table='discounts';

    public static function calculateDiscount($amount, $discount_type){
        $calculated_discount=0;
        $discount=Discount::where('discount_type', $discount_type)->first();
        if($discount){
            if($discount_type=='instant'){
                if($discount->sub_type=='percent') {
                    $calculated_discount=intval($amount*$discount->value/100);
                }
                else{
                    $calculated_discount=$discount->value;
                }
            }
        }
        return $calculated_discount;

    }
}
