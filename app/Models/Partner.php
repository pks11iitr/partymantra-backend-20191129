<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    use Active;

    protected $table = 'partners';

    protected $fillable=['name', 'header_image', 'small_image', 'description', 'address', 'short_address', 'lat', 'lang', 'contact_no', 'type', 'per_person_text', 'isactive', 'user_id'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by','lat', 'lang', 'user_id'];

    public function user(){
        return $this->belongsTo('App\Users', 'user_id');
    }

    public function events(){
        return $this->hasMany('App\Models\PartnerEvent', 'partner_id');
    }

    public function getHeaderImageAttribute($value)
    {
        return Storage::url($value);
    }

    public function getSmallImageAttribute($value){
        return Storage::url($value);
    }

    public function packages(){
        return $this->hasMany('App\Models\Package', 'partner_id');
    }

}
