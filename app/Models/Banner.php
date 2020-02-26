<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use Active;

    protected $table='banners';

    protected $fillable=['image', 'entity_id', 'entity_type','isactive', 'priority','placeholder'];

    protected $hidden = ['created_at','deleted_at','updated_at'];

    public function getImageAttribute($value){
        return Storage::url($value);
    }

    public function partner(){
        if($this->entity_type=='restaurant' || $this->entity_type=='party'){
            $partner=Partner::where('id', $this->entity_id)->first();
            return $partner;
        }else{
            $partner=PartnerEvent::where('id', $this->entity_id)->first();
            return $partner;
        }
    }
}
