<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table='discounts';

    protected $appends=['discount_text'];

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

    public function getDiscountTextAttribute($value){
        if($this->discount_type=='instant'){
            if($this->sub_type=='percent'){
                $text='Instant Discount ('.$this->value.'%)';
            }else{
                $text='Instant Discount ('.$this->value.'INR)';
            }
        }else if($this->discount_type=='cashback'){
            if($this->sub_type=='percent'){
                $text='Cashback ('.$this->value.'%)';
            }else{
                $text='Cashback ('.$this->value.'INR)';
            }
        }
        return $text;
    }
}
