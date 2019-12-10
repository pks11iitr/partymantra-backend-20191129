<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = 'categories';
   
   protected $fillable = ['name','image','isactive','creator_id'];
   
   protected $hidden = ['creator_id','created_at','deleted_at','updated_at'];
}
