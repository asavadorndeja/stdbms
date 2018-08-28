<?php

namespace App\Http\Controllers;
use App\user;
use App\tel1;
use Illuminate\Http\Request;

class Tel1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $userTE = auth()->user()->userTE;
        $name = auth()->user()->name;

        if ($userTE >= 2){
          $tel1s = tel1::orderby('tel1Number','desc')->paginate(20);
          return view('pages.te.l1.index', compact('tel1s','userTE'));
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
        $userName = auth()->user()->name;

        $tel1LastNumber = tel1::orderby('tel1Number','desc')->select('tel1Number')->first()->tel1Number;

        // dd($tel1LastNumber);

        $curYear = (int)date("Y") % 100;
        $proYear = (int)floor($tel1LastNumber / 100);


        if ($curYear == $proYear) {
          $tel1Number = $tel1LastNumber + 1;
        }elseif ($curYear > $proYear) {
          $tel1Number = $curYear * 100 + 1;
        }

        return view('pages.te.l1.create', compact('tel1Number', 'userName'));
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
        $this->validate(request(), [
          'tel1Number' => 'required',
          'tel1Title' => 'required',
        ]);

        tel1::create([
          'tel1Number'  => request('tel1Number'),
          'tel1Title' => request('tel1Title'),
          'create_by' => auth()->user()->name,
        ]);

      return redirect()->route('tel1.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tel1  $tel1
     * @return \Illuminate\Http\Response
     */
    public function show(tel1 $tel1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tel1  $tel1
     * @return \Illuminate\Http\Response
     */
    public function edit(tel1 $tel1)
    {
        //
        // dd($tel1);
        $userTE = auth()->user()->userTE;
        $tel1 = tel1::where('id',$tel1->id)->first();
        // $hrCategories = hrl1Category::all();
        // $hrPositions = hrl1Position::all();
        // $hrSupervisors = User::all();
        //
        $teStatuses = \Config::get('constant.tel1Statuses');
        $tePhases = \Config::get('constant.tel1Phases');
        $tePotentials = \Config::get('constant.tel1Potentials');
        $teServices = \Config::get('constant.tel1Services');
        $teBidMethods = \Config::get('constant.tel1BidMethods');
        $teBidCompetitors = \Config::get('constant.tel1BidCompetitors');
        $teReasons = \Config::get('constant.tel1Reasons');
        $Currencies = \Config::get('constant.Currencies');

        return view('pages.te.l1.edit', compact('tel1','teBidCompetitors','teBidMethods' , 'teServices', 'teStatuses','tePhases','tePotentials','teReasons','Currencies','userTE'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tel1  $tel1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tel1 $tel1)
    {
        //

        $tel1 = tel1::find($tel1->id)->update($request->all());
        return redirect()->route('tel1.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tel1  $tel1
     * @return \Illuminate\Http\Response
     */
    public function destroy(tel1 $tel1)
    {
        //
        // dd($tel1);
        $tel1 = tel1::find($tel1->id)->delete();
        return redirect()->route('tel1.index');
    }

    public function tel1Export()
    {
      $tel1s = tel1::all();
      $csvExporter = new \Laracsv\Export();
      $csvExporter->build($tel1s,[
        'tel1Number' => 'Tender number',
        'tel1Client' => 'Client name',
        'tel1ClientRef' => 'Client reference',
        'tel1Title' => 'Tender title',
        'tel1Service' => 'Service',
        'tel1Phase' => 'Phase',
        'tel1Status' => 'Status',
        'tel1Remark' => 'Remark',
        'tel1Potential' => 'Potential',
        'tel1BidMethod' => 'Bid method',
        'tel1BidCompetitor' => 'Bid competitor',
        'tel1DateInquiry' => 'Inquiry date',
        'tel1DateInquiryDueDate' => 'Inquiry due date',
        'tel1DateSubmit' => 'Sumission date',
        'tel1DateHold' => 'Hold date',
        'tel1DateTurnDown' => 'Turndown date',
        'tel1DateAward' => 'Award date',
        'tel1DateComplete' => 'Complete date',
        'tel1ReasonTurndown' => 'Turndown reason',
        'tel1SuccessBidder' => 'Successful bidder',
        'tel1Price' => 'Price',
        'tel1Currency' => 'Currency',
        'tel1CurrencyConversion' => 'Conversion rate',
        'tel1PriceTHB' => 'Price (THB)',
        'tel1FcDateStart' => 'Forecast start date',
        'tel1FcDateFinish' => 'Forecast end date',
        'tel1FcDuration' => 'Forecast duration',
        'tel1FcManPower' => 'Forecast man power',
        'tel1FcManHour' => 'Forecast man hour',
        ])->download();
      // return redirect()->route('user.index');
    }
}
