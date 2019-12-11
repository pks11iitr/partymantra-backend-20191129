<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use Active;
	protected $table='menus';



    protected $fillable=['name', 'image', 'price', 'cut_pice', 'category_id', 'description', 'isactive', 'creator_id', 'partner_id'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by', 'isactive', 'pivot'];

    public function getImageAttribute($value){
        return Storage::url($value);
    }
}
