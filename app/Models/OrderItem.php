<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_details';

    protected $fillable=['order_id','entity_type','entity_id','other_id','men','women','couple'];

    public function entity(){
        return $this->morphTo();
    }



}
