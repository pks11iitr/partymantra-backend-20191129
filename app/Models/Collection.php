<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table ='collections';

	protected $fillable=['name', 'cover_image', 'created_by'];
	
    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by', 'isactive', 'priority'];

    use Active;

    public function event(){
        return $this->belongsToMany('App\Models\PartnerEvent', 'collection_event', 'collection_id', 'event_id')->where('isactive', true)->limit(1);
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

}
