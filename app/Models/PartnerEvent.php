<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerEvent extends Model
{
    protected $table='events';

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by', 'isactive', 'priority', 'lat', 'lang', 'partner_id', 'pivot'];


    public function partner(){
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Package', 'event_id');
    }
}
