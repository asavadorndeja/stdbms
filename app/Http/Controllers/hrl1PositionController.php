<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Hrl1PositionController extends Controller
{
    //
    public function hrl1Position()
    {
       return $this->belongsTo('hrl1Category');
    }
}
