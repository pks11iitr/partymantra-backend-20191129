<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Collection extends Model
{
    use Active;

    protected $table ='collections';

	protected $fillable=['name', 'cover_image', 'small_image', 'created_by','isactive'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by', 'isactive', 'priority'];

    public function event(){
        return $this->belongsToMany('App\Models\PartnerEvent', 'collection_event', 'collection_id', 'event_id')->where('isactive', true)->limit(9);
    }

    public function party(){
        return $this->belongsToMany();
    }

    public function restaurant(){
        return $this->belongsToMany();
    }

    public function allevents(){
        return $this->belongsToMany('App\Models\PartnerEvent', 'collection_event', 'collection_id', 'event_id')->where('isactive', true);
    }

    public function getCoverImageAttribute($value)
    {
        return Storage::url($value);
    }
    public function getSmallImageAttribute($value)
    {
        return Storage::url($value);
    }

}
