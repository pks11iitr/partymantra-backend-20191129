<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $fillable=['name', 'header_image', 'small_image', 'description', 'address', 'short_address', 'lat', 'lang', 'contact_no', 'type', 'per_person_text', 'isactive', 'user_id'];



    public function user(){
        return $this->belongsTo('App\Users', 'user_id');
    }

}
