<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use App\Models\Traits\ReviewTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    use Active,ReviewTrait,DocumentUploadTrait;

    protected $table = 'partners';

    protected $fillable=['name', 'header_image', 'small_image', 'description', 'address', 'short_address', 'lat', 'lang', 'contact_no', 'type', 'per_person_text', 'isactive', 'user_id', 'allow_party','timings','party_timings','open','close'];

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
        return $this->belongsToMany('App\Models\Facility', 'restaurant_facility', 'restaurant_id', 'facility_id');
    }

    public function menus(){
        return $this->belongsToMany('App\Models\Menu', 'partner_menus', 'partner_id', 'menu_id')->withPivot(['price','cut_price']);
    }

    public function eventparty(){
        return $this->gallery()->whereIn('other_type', ['eventonrestaurant', 'partyonrestaurant']);
    }

}
