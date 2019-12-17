<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'gallery';

    protected $fillable=['doc_path', 'entity_type', 'entity_id', 'uploaded_by'];

    protected $hidden=['id', 'created_at', 'deleted_at', 'uploaded_by', 'entity_type', 'entity_id','isactive', 'partneractive'];

}
