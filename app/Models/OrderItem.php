<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_details';

    protected $fillable=['order_id','entity_type','entity_id','optional_type', 'other_type','other_id','men','women','couple', 'partner_id', 'no_of_pass', 'price'];

    public function entity(){
        return $this->morphTo();
    }

    public function package(){
        return $this->belongsTo('App\Models\Package', 'other_id');
    }

    public function other(){
        return $this->morphTo();
    }

    public function order(){
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function partner(){
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }


}
