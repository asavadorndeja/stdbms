<?php

namespace App\Http\Controllers;
use App\user;
use App\tel1;
use App\pel2;
use Illuminate\Http\Request;

class Pel2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //
        $userPE = auth()->user()->userPE;
        $name = auth()->user()->name;

        $pel2s = pel2::where('tel1Number', '=', request('tel1Number'))->get();
        $tel1Number = request('tel1Number');
        return view('pages.pe.l2.index', compact('pel2s', 'tel1Number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        // $tel1id = request('id');
        // $tel1Number = tel1::find($tel1id)->first()->teNumber;
        // dd($request->id);
        $tel1Number = $request->id;
        return view('pages.pe.l2.create', compact('tel1Number'));
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
        // dd($request);
        $tel1Number = $request->tel1Number;

        $this->validate(request(), [
          'pel2Number' => 'required',
          'pel2Title' => 'required',
        ]);

        pel2::create([
          'tel1Number'  => request('tel1Number'),
          'pel2Number' => request('pel2Number'),
          'pel2Title' => request('pel2Title'),
          'pel2Description' => request('pel2Description'),
          'pel2Budget' => request('pel2Budget'),
          'create_by' => auth()->user()->name,
        ]);

        return redirect()->route('pel2.index', ['tel1Number'=>$tel1Number]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pel2  $pel2
     * @return \Illuminate\Http\Response
     */
    public function show(pel2 $pel2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pel2  $pel2
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // dd($id);
        $pel2s = pel2::find($id);
        $tel1Number = pel2::find($id)->tel1Number;
        $userName = auth()->user()->name;
        return view('pages.pe.l2.edit',compact('pel2s', 'userName', 'tel1Number'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pel2  $pel2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pel2 $pel2)
    {
        //
        // dd($request, $pel2);
        $pel2s = pel2::where('id',$pel2->id)->first()->update($request->all());
        return redirect()->route('pel2.index', ['tel1Number'=>$pel2->tel1Number]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pel2  $pel2
     * @return \Illuminate\Http\Response
     */
    public function destroy(pel2 $pel2)
    {
        //
        // dd($pel2);
        $pel2s = pel2::where('id',$pel2->id)->delete();
        return redirect()->route('pel2.index', ['tel1Number'=>$pel2->tel1Number]);

    }
    public function pel2Export()
    {
      $pel2s = pel2::all();
      $csvExporter = new \Laracsv\Export();
      $csvExporter->build($pel2s,[
        'tel1Number' => 'Project number',
        'pel2Number' => 'CTR number',
        'pel2Title' => 'CTR title',
        'pel2Description' => 'CTR descritption',
        'pel2Budget' => 'CTR budget hour',
        ])->download();
      // return redirect()->route('user.index');

    }

}
