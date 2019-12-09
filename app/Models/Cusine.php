<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cusine extends Model
{
    protected $table='cusines';
    
    protected $fillable=['name', 'creator_id'];
    
}
