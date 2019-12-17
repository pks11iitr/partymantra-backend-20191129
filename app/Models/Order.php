<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';

    protected $fillable=['refid'];

    protected $hidden=['user_id', 'payment_text', 'deleted_at', 'created_at'];

    public function details(){
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function customer(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function review(){
        return $this->hasOne('App\Models\Review', 'order_id');
    }

}
