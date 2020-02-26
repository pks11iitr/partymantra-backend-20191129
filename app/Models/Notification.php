<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Notification extends Model
{
    protected $table='notifications';

    protected $fillable=['title','description', 'image', 'user_id','receiver_type','is_sent'];

    protected $appends=['date'];

    public function getImageAttribute($value)
    {
        if(empty($value))
            return '';
        else
            return Storage::url($value);
    }

    public function getDateAttribute(){
        return date('D, d M Y', strtotime($this->created_at));
    }
}
