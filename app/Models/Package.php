<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use Active;
    protected $table='event_packages';
    protected $fillable = ['package_name','text_under_name','price','custom_package_detail','isactive','event_id','partneractive','partner_id','created_by', 'package_type'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at','created_by'];

    public function event(){
        return $this->belongsTo('App\Models\PartnerEvent', 'event_id');
    }
    public function menus(){
        return $this->belongsToMany('App\Models\Menu', 'package_menu', 'package_id', 'menu_id');
    }

    public function activemenus(){
        return $this->belongsToMany('App\Models\Menu', 'package_menu', 'package_id', 'menu_id')->where('isactive', true);
    }

    public function partner(){
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }






}
