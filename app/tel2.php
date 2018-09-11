<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class tel2 extends Model
{
    //

    protected $guarded = [
        'id',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function tel1Post()
    {
    return $this->belongsTo(tel1::class);
    }

}
