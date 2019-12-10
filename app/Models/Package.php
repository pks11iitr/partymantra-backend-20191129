<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table='event_packages';

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by', 'isactive', 'priority', 'lat', 'lang', 'partner_id', 'pivot'];

    public function menus(){
        return $this->belongsToMany('App\Models\Menu', 'package_menu', 'package_id', 'menu_id');
    }

    public function activemenus(){
        return $this->belongsToMany('App\Models\Menu', 'package_menu', 'package_id', 'menu_id')->where('isactive', true);
    }

    public function event(){
        return $this->belongsTo('App\Models\Event', 'event_id');
    }



}
