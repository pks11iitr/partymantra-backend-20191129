<?php

namespace App\Models\Traits;

trait ReviewTrait {

    public function reviews(){
        return $this->morphMany('App\Models\Review', 'entity');
    }

}
