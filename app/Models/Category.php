<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
   use Active;

   protected $table = 'categories';

   protected $fillable = ['name','image','isactive','creator_id'];

   protected $hidden = ['creator_id','created_at','deleted_at','updated_at'];

   public function getImageAttribute($value){
       return Storage::url($value);
   }

}
