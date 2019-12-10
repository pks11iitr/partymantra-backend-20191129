<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table='banners';

    protected $visible=['image', 'entity_id', 'entity_type'];
    
    protected $hidden = ['created_at','deleted_at','updated_at'];
}
