<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\ReviewTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    use Active,ReviewTrait;

    protected $table = 'partners';

    protected $fillable=['name', 'header_image', 'small_image', 'description', 'address', 'short_address', 'lat', 'lang', 'contact_no', 'type', 'per_person_text', 'isactive', 'user_id'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by','user_id'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
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

    public function facilities(){
        return $this->belongsToMany('App\Models\Facility', 'event_facility', 'event_id', 'facility_id');
    }

    public function menus(){
        return $this->hasMany('App\Models\Menu', 'partner_id');
    }

}
