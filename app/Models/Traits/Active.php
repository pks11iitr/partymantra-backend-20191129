<?php

namespace App\Models\Traits;

trait Active{
    public static function active(){
        return self::where('isactive', true);
    }

    public function statustext(){
        if(!is_null($this->partneractive))
            return ($this->isactive&&$this->partneractive)?'active':($this->partneractive==1?'under-moderation':'inactive');

        return $this->isactive==1?'active':'inactive';
    }

}
