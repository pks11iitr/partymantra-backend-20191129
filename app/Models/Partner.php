<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';

    protected $fillable=[];

    public function user(){
        return $this->belongsTo('App\Users', 'user_id');
    }

}
