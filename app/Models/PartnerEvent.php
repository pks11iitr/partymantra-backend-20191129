<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use App\Models\Traits\Gallery;
use App\Models\Traits\ReviewTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PartnerEvent extends Model
{
    use Active, ReviewTrait, DocumentUploadTrait;

    protected $table='events';

    protected $appends = array('time_to_start', 'away');

    protected $fillable=['title', 'creator_id','startdate', 'enddate', 'description', 'venue_name', 'venue_adderss', 'lat', 'lang', 'header_image', 'small_image', 'tnc', 'custom_package_details','per_person_text', 'isactive', 'markasfull','partner_id','partneractive', 'priority', 'istop'];

    protected $hidden=['created_at', 'deleted_at', 'updated_at', 'partner_id','isactive', 'markasfull','partner_id','partneractive','pivot','istop'];

    public function partner(){
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Package', 'event_id')->where('package_type', 'other');
    }

    public function covers()
    {
        return $this->hasMany('App\Models\Package', 'event_id')->where('package_type', 'cover');
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

    public function order(){
        return $this->morphMany('App\Models\OrderItem', 'entity');
    }

    public function collections(){
        return $this->belongsToMany('App\Models\Collection', 'collection_event', 'event_id', 'collection_id');
    }

    public function getStartdateAttribute($value){
        return date('D M d,Y H:i a', strtotime($value));
        //return $value;
    }

    public function getEnddateAttribute($value){
        return date('D M d,Y H:i a', strtotime($value));
    }

    public function getTimeToStartAttribute()
    {
        $date=$this->getOriginal('startdate');
        $diff=strtotime($date)-strtotime("now");
        if($diff>=0) {
            $hours = intval($diff / (60 * 60));
            $days = intval($hours / 24);
            $hours = $hours % 24;
            return $days . ' days ' . $hours . ' hrs';
        }else{
            return 'Started';
        }
    }

    public function getAwayAttribute(){
        if((request('lat')||session('lat'))&&(request('lat')||session('lat')))
           return intval($this->distance(request('lat')??session('lat'), request('lang')??session('lang'), $this->lat, $this->lang, 'K'));
        return 0;
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

    public function facilities(){
        return $this->belongsToMany('App\Models\Facility', 'event_facility', 'event_id', 'facility_id');
    }

    public static function nearBy($lat, $lang){
        $events=[];
        if(!empty($lat) && !empty($lang)){
            $haversine = "(6371 * acos(cos(radians($lat))
                     * cos(radians(events.lat))
                     * cos(radians(events.lang)
                     - radians($lang))
                     + sin(radians($lat))
                     * sin(radians(events.lat))))";

            $events = PartnerEvent::active()
                ->with(["avgreviews"])
                ->orderBy(DB::raw("$haversine"), 'asc')->where(DB::raw("$haversine"),'<', 10000)->get();
        }

        foreach($events as $item){
            $item->newreviews=count($item->avgreviews)?$item->avgreviews[0]->rating:"0.0";
            $item->newcount=count($item->avgreviews)?$item->avgreviews[0]->reviews:0;

        }
        return $events;
    }

}
