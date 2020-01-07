<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='cart';

    protected $fillable=['user_id','entity_type','entity_id','other_id','men','women','couple','email', 'mobile', 'name', 'partner_id', 'no_of_pass'];

    public function entity(){
        return $this->morphTo();
    }

    public function package(){
        return $this->belongsTo('App\Models\Package', 'other_id');
    }
}
