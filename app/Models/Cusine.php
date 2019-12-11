<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class Cusine extends Model
{
    use Active;
    protected $table='cusines';

    protected $fillable=['name', 'creator_id'];

}
