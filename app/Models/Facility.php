<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table ='facilities';

    protected $hidden=['id', 'created_at', 'deleted_at', 'updated_at', 'isactive','pivot', 'creator_id'];
}
