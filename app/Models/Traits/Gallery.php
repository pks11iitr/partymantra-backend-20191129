<?php

namespace App\Models\Traits;

trait Gallery{

    public function gallery(){
        return $this->morphMany('App\Models\Document', 'entity');
    }

}
