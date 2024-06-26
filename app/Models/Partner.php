<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use App\Models\Traits\ReviewTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    use Active,ReviewTrait,DocumentUploadTrait;

    protected $table = 'partners';

    protected $fillable=['name', 'header_image', 'small_image', 'description', 'address', 'short_address', 'lat', 'lang', 'contact_no', 'type', 'per_person_text', 'isactive', 'user_id', 'allow_party','timings','party_timings','open','close'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by','user_id'];

    protected $appends=['discounts','away'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function events(){
        return $this->hasMany('App\Models\PartnerEvent', 'partner_id');
    }

    public function getHeaderImageAttribute($value)
    {
        if($value)
            return Storage::url($value);
        return '';
    }

    public function getSmallImageAttribute($value){
        if($value)
            return Storage::url($value);
        return '';
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

    public function collections(){
        return $this->belongsToMany('App\Models\Collection', 'collection_restaurant', 'restaurant_id', 'collection_id');
    }

    public function getDiscountsAttribute($value){
        $discount=Discount::where('discount_type', 'instant')->first();
        if($discount){
            return "Pay bill using TPM & get ".($discount->value)."% instant discount";
        }
        return null;
    }

    public function getAwayAttribute(){
        return intval($this->distance(request('lat'), request('lang'), $this->lat, $this->lang, 'K'));
    }


    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

    public static function nearBy($lat, $lang){
        $restaurants=[];
        if(!empty($lat) && !empty($lang)) {
            $haversine = "(6371 * acos(cos(radians($lat))
                     * cos(radians(partners.lat))
                     * cos(radians(partners.lang)
                     - radians($lang))
                     + sin(radians($lat))
                     * sin(radians(partners.lat))))";

            $restaurants = Partner::active()
                ->with(["avgreviews"])
                ->orderBy(DB::raw("$haversine"), 'asc')->where(DB::raw("$haversine"), '<', 10000)->get();
        }

        foreach($restaurants as $item){
            $item->newreviews=count($item->avgreviews)?$item->avgreviews[0]->rating:"0.0";
            $item->newcount=count($item->avgreviews)?$item->avgreviews[0]->reviews:0;

        }

        return $restaurants;
    }

    public static function nearByParty($lat, $lang){
        $party=[];
        if(!empty($lat) && !empty($lang)) {
            $haversine = "(6371 * acos(cos(radians($lat))
                     * cos(radians(partners.lat))
                     * cos(radians(partners.lang)
                     - radians($lang))
                     + sin(radians($lat))
                     * sin(radians(partners.lat))))";

            $party = Partner::active()
                ->where('allow_party', true)
                ->with(["avgreviews"])
                ->orderBy(DB::raw("$haversine"), 'asc')->where(DB::raw("$haversine"), '<', 10000)->get();
        }

        foreach($party as $item){
            $item->newreviews=count($item->avgreviews)?$item->avgreviews[0]->rating:"0.0";
            $item->newcount=count($item->avgreviews)?$item->avgreviews[0]->reviews:0;

        }

        return $party;
    }



}
