<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use Active;
	protected $table='menus';



    protected $fillable=['name', 'image', 'price', 'cut_pice', 'category_id', 'description', 'isactive', 'creator_id', 'partner_id','partneractive'];

    protected $hidden=['created_at', 'updated_at', 'deleted_at', 'created_by', 'isactive'];

    public function getImageAttribute($value){
        if($value)
            return Storage::url($value);
        return '';
    }

    public function partner(){
        return $this->belongsToMany('App\Models\Partner', 'partner_menus','menu_id', 'partner_id')->withPivot(['price','cut_price']);
    }
}
