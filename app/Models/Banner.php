<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use Active;

    protected $table='banners';

    protected $fillable=['image', 'entity_id', 'entity_type','isactive', 'priority'];

    protected $hidden = ['created_at','deleted_at','updated_at'];

    public function getImageAttribute($value){
        return Storage::url($value);
    }
}
