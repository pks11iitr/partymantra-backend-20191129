<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

	protected $table='menus';


    
    protected $fillable=['name', 'image', 'price', 'cut_pice', 'category_id', 'description', 'isactive', 'creator_id', 'partner_id'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by', 'isactive', 'pivot'];

}
