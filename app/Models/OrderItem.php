<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_details';

    protected $fillable=['order_id','entity_type','entity_id','other_id','men','women','couple', 'partner_id', 'no_of_pass', 'price'];

    public function entity(){
        return $this->morphTo();
    }

    public function package(){
        return $this->belongsTo('App\Models\Package', 'other_id');
    }


}
