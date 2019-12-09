<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menus';

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by', 'isactive', 'pivot'];
}
