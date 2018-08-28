<?php

namespace App\Http\Controllers;
use App\user;
use App\tel1;
use App\pel1;

use Illuminate\Http\Request;

class Pel1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userPE = auth()->user()->userPE;
        $name = auth()->user()->name;

        if ($userPE >= 2){
          $tel1s = tel1::where('tel1Status','=','Awarded')->orderby('tel1Number','desc')->paginate(20);
          // dd($tel1s);
          return view('pages.pe.l1.index', compact('tel1s','userPE'));
        }else{
          return redirect()->route('home');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pel1  $pel1
     * @return \Illuminate\Http\Response
     */
    public function show(pel1 $pel1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pel1  $pel1
     * @return \Illuminate\Http\Response
     */
    public function edit(pel1 $pel1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pel1  $pel1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pel1 $pel1)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pel1  $pel1
     * @return \Illuminate\Http\Response
     */
    public function destroy(pel1 $pel1)
    {
        //
    }
}
