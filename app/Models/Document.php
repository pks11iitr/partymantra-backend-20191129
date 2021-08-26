<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $table = 'gallery';

    protected $fillable=['doc_path', 'entity_type', 'entity_id', 'uploaded_by','other_type','other_id'];

    protected $hidden=['id', 'created_at', 'deleted_at', 'uploaded_by', 'entity_type', 'entity_id','isactive', 'partneractive'];

    public function getDocPathAttribute($value){
        if($value)
            return Storage::url($value);
        return '';
    }

}
