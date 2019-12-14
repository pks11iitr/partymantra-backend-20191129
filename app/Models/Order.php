<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';

    protected $fillable=['refid'];

    public function details(){
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function customer(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
