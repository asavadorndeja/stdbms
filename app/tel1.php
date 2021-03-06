<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tel1 extends Model
{
    //

    protected $guarded = [
        'id',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function tel1Comments()
    {
      return $this->hasMany(tel2::class);
    }

}
