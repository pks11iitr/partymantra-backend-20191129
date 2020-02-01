<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';

    protected $appends = array('order_date');

    protected $fillable=['refid'];

    protected $hidden=['user_id', 'payment_text', 'deleted_at', 'created_at', 'payment_id_response', 'order_id_response','usingwallet','fromwallet'];


    public function details(){
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function customer(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function review(){
        return $this->hasOne('App\Models\Review', 'order_id');
    }

    public function getOrderDateAttribute()
    {
        return date('D M d,Y H:i a', strtotime($this->updated_at));
    }

}
