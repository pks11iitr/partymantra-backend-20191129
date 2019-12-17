<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\ReviewTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PartnerEvent extends Model
{
    use Active, ReviewTrait;

    protected $table='events';

    protected $fillable=['title', 'creator_id','startdate', 'enddate', 'description', 'venue_name', 'venue_adderss', 'lat', 'lang', 'header_image', 'small_image', 'tnc', 'custom_package_details', 'isactive', 'markasfull','partner_id','partneractive'];

    protected $hidden=['created_at', 'deleted_at', 'updated_at', 'partner_id','lat', 'lang'];

    public function partner(){
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Package', 'event_id');
    }

    public function getHeaderImageAttribute($value)
    {
        return Storage::url($value);
    }

    public function getSmallImageAttribute($value){
        return Storage::url($value);
    }

    public function order(){
        return $this->morphMany('App\Models\OrderItem', 'entity');
    }

    public function collections(){
        return $this->belongsToMany('App\Models\Collection', 'collection_event', 'event_id', 'collection_id');
    }


}
