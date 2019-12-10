<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    
    protected $table = 'events';
    protected $fillable=['title', 'startdate', 'enddate', 'description', 'venue_name', 'venue_adderss', 'lat', 'lang', 'header_image', 'small_image', 'tnc', 'custom_package_details', 'isactive', 'markasfull'];



    protected $hidden=['created_at', 'deleted_at', 'updated_at', 'partner_id','lat', 'lang'];

}
