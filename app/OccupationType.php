<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OccupationType extends Model
{
    //
    protected $table = 'occupation_type';

    public function member()
    {
        return $this->hasMany('App\Member');
    }
}
