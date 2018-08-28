<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pel4 extends Model
{
    //

    protected $guarded = [
        'id',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
