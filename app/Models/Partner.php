<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';

    protected $fillable=[];

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by','lat', 'lang', 'user_id'];

    public function user(){
        return $this->belongsTo('App\Users', 'user_id');
    }

    public function events(){
        return $this->hasMany('App\Models\PartnerEvent', 'partner_id');
    }

}
