<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
     protected $table='collections';
    
    protected $fillable=['name', 'cover_image', 'created_by'];
}
