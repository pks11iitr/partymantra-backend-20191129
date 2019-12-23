<?php

namespace App\Models\Traits;
use DB;

trait ReviewTrait {

    public function reviews(){
        return $this->morphMany('App\Models\Review', 'entity');
    }

    public function avgreviews(){
        return $this->reviews()
            ->selectRaw('entity_id, avg(rating) as rating, count(*) as reviews')
            ->groupBy('entity_id');
    }

}
