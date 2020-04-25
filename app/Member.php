<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $table = 'members';

    public function occupation_type()
    {
        return $this->belongsTo('App\OccupationType', 'occupation_id');
    }
}
