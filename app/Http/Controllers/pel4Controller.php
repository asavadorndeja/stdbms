<?php

namespace App\Http\Controllers;
use App\hrl1;
use App\tel1;
use App\pel2;
use App\pel4;
use Illuminate\Http\Request;

class Pel4Controller extends Controller
{


    public function __construct()
      {

        $this->middleware('auth');

      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);

        $userPE = auth()->user()->userPE;


        if(isset($request->dateFrom)){
          $dateFrom = $request->dateFrom;
        }else{
          $dateFrom = date('Y-m-d', strtotime('last Friday')-14*24*60*60);
        }

        if(isset($request->dateFrom)){
          $dateTo = $request->dateTo;
        }else{
          $dateTo =date('Y-m-d', strtotime('this Friday'));
        }

        $userName = auth()->user()->name;

        $pel4s = pel4::where('create_by', $userName)->whereBetween('pel4Date',[$dateFrom, $dateTo])->orderBy('pel4Date', 'desc')->get();
        return view('pages.pe.l4.index', compact('pel4s', 'userName', 'dateFrom', 'dateTo','userPE'));
    }

    public function indexDelete(Request $request)
    {
        // dd($request);

        $userPE = auth()->user()->userPE;


        if(isset($request->dateFrom)){
          $dateFrom = $request->dateFrom;
        }else{
          $dateFrom = date('Y-m-d', strtotime('last Friday')-14*24*60*60);
        }

        if(isset($request->dateFrom)){
          $dateTo = $request->dateTo;
        }else{
          $dateTo =date('Y-m-d', strtotime('this Friday'));
        }

        $userName = auth()->user()->name;

        $pel4s = pel4::whereBetween('pel4Date',[$dateFrom, $dateTo])->orderBy('id', 'desc')->get();
        return view('pages.pe.l4.indexDelete', compact('pel4s', 'userName', 'dateFrom', 'dateTo','userPE'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tel1s = tel1::where('tel1Status','Awarded')->get();
        $pel2s = pel2::wherein('tel1Number', $tel1s->pluck('tel1Number'))->get();
        $timeItems = [0.5, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 4.5, 5.0, 5.5, 6.0, 6.5, 7.0, 7.5, 8.0];
        $userName = auth()->user()->name;
        return view('pages.pe.l4.create', compact('tel1s', 'pel2s', 'userName', 'timeItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // dd($request);
      $datas = $request->input('data');
      // dd($datas);

      foreach($datas as $data){
        pel4::create([
          'tel1id' => $data[1],
          'tel1Number' => $data[2],
          'tel1Title' => $data[3],
          'pel2id'  => $data[4],
          'pel2Number' => $data[5],
          'pel2Title' => $data[6],
          'pel4Date' => $data[7],
          'pel4Hour' => $data[8],
          'pel4Remark' => $data[9],
          'create_by' => auth()->user()->name,
        ]);
      }

      return redirect(route('pel4.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pel4  $pel4
     * @return \Illuminate\Http\Response
     */
    public function show(pel4 $pel4)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pel4  $pel4
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $userName = auth()->user()->name;
        $userTeam =hrl1::where('hrl1Supervisor', $userName)->pluck('name');
        $pel4ss = pel4::wherein('create_by', $userTeam)->get();
        $pel4s = $pel4ss->where('pel4Status', 'Submitted');
        $dateFrom = date('Y-m-d', strtotime('last Friday')-14*24*60*60);
        $dateTo =date('Y-m-d', strtotime('this Friday'));

        // dd($userTeam, $pel4ss);
        return view('pages.pe.l4.edit',compact('pel4s', 'userName', 'userTeam','dateFrom','dateTo'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pel4  $pel4
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        // dd($request);
        $approver = auth()->user()->name;
        $datas = $request->tsStatus;
        $appList = array_keys($datas, 'Approved');
        $rejList = array_keys($datas, 'Rejected');
        // dd($request, $datas, $appList, $rejList);

        // $pel4s = pel4::wherein('id', $appList)->update(['tsStatusLog' => 'Approve']);
        // $pel4s = pel4::wherein('id', $rejList)->update(['tsStatusLog' => 'Reject']);
        $pel4s = pel4::wherein('id', $appList)->update(['pel4Status' => 'Approved', 'approve_by' => $approver ]);
        $pel4s = pel4::wherein('id', $rejList)->update(['pel4Status' => 'Rejected', 'approve_by' => $approver ]);
        // $pel4s = pel4::wherein('tsStatus', $appList)->update(['tsStatusLog' => '1']);
        // dd("done");
        return redirect(route('pel4.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pel4  $pel4
     * @return \Illuminate\Http\Response
     */
    public function destroy(pel4 $pel4)
    {
        //
        // dd($pel4->id);
        $pel4 = pel4::find($pel4->id)->delete();
        return redirect()->route('pel4.indexDelete');

    }

    public function pel4ExportUser(Request $request)
    {

      // dd($request);
      $dateFrom = $request->dateFromExport;
      $dateTo = $request->dateToExport;
      // dd($dateFrom, $dateTo);

      $userName = auth()->user()->name;
      $pel4s = pel4::where('create_by', $userName)->whereBetween('pel4Date',[$dateFrom, $dateTo])->orderBy('pel4Date', 'desc')->get();

      $csvExporter = new \Laracsv\Export();
      $csvExporter->build($pel4s,[
        'tel1Number' => 'Project number',
        'tel1Title' => 'Project title',
        'pel2Number' => 'CTR number',
        'pel2Title' => 'CTR title',
        'pel4Date' => 'Date',
        'pel4Hour' => 'Hour(s)',
        'pel4Remark' => 'Remark',
        'pel4Status' => 'Status',
        'create_by' => 'created by',
        'approve_by' => 'Approved by',
        ])->download();
      // return redirect()->route('user.index');
    }

    public function pel4ExportAllUser(Request $request)
    {

      // dd($request);
      $dateFrom = $request->dateFromExport;
      $dateTo = $request->dateToExport;
      // dd($dateFrom, $dateTo);

      $userName = auth()->user()->name;
      $pel4s = pel4::whereBetween('pel4Date',[$dateFrom, $dateTo])->orderBy('pel4Date', 'desc')->get();

      $csvExporter = new \Laracsv\Export();
      $csvExporter->build($pel4s,[
        'tel1Number' => 'Project number',
        'tel1Title' => 'Project title',
        'pel2Number' => 'CTR number',
        'pel2Title' => 'CTR title',
        'pel4Date' => 'Date',
        'pel4Hour' => 'Hour(s)',
        'pel4Remark' => 'Remark',
        'pel4Status' => 'Status',
        'create_by' => 'created by',
        'approve_by' => 'Approved by',
        ])->download();
      // return redirect()->route('user.index');
    }
}
