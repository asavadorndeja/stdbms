<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hrl1Category extends Model
{
    //
    public function hrl1Category()
    {
       return $this->hasMany('hrl1Position');
    }

}
