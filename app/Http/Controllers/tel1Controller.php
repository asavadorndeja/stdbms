<?php

namespace App\Http\Controllers;
use App\user;
use App\tel1;
use App\tel2;
use App\hrl1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use DateTime;
use DatePeriod;
use DateInterval;

use App\Charts\SampleChart;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Tel1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //
        $teStatuses = \Config::get('constant.tel1Statuses');;
        array_push($teStatuses,"All");

        // dd($request);

        $userTE = auth()->user()->userTE;
        $name = auth()->user()->name;

        if(isset($request->dateFrom)){
          $dateFrom = $request->dateFrom;
        }else{
          $dateFrom = "2015-01-01";
        }

        if(isset($request->dateFrom)){
          $dateTo = $request->dateTo;
        }else{
          $dateTo =date('Y-m-d', strtotime('this Friday'));
        }

        if(isset($request->selectedStatus)){
          $selectedStatus = $request->selectedStatus;
        }else{
          $selectedStatus = 'All';
        }

        // dd($selectedStatus);

        if ($userTE >= 2){
          if($selectedStatus  == 'All'){
            $tel1s = tel1::orderby('tel1Number','desc')
            ->whereBetween('tel1DateInquiry',[$dateFrom, $dateTo])
            ->paginate(20);
          }else{
            $tel1s = tel1::orderby('tel1Number','desc')
            ->whereBetween('tel1DateInquiry',[$dateFrom, $dateTo])
            ->where('tel1Status','=',$selectedStatus)
            ->paginate(20);
          }
          return view('pages.te.l1.index', compact('tel1s','userTE','dateFrom','dateTo','teStatuses','selectedStatus'));
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
          'tel1Status' => 'Inquiry',
          'tel1DateInquiry' => Carbon::now(),
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

        $tel2s = tel2::where('tel1Number',$tel1->tel1Number)->get();
        // $tel2 = tel2::all();

        // dd($tel2);

        return view('pages.te.l1.edit', compact('tel1','tel2s','teBidCompetitors','teBidMethods' , 'teServices', 'teStatuses','tePhases','tePotentials','teReasons','Currencies','userTE'));

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
      return redirect()->route('user.index');

      // $spreadsheet = new Spreadsheet();
      // $sheet = $spreadsheet->getActiveSheet();
      // $sheet->setCellValue('A1', 'Hello World !');
      //
      // dd($spreadsheet);
      //
      // $writer = new Xlsx($spreadsheet);
      // $writer->save('hello world.xlsx');

    }


    public function tel1TenderbyStatus()
    {

      $Statuses = \Config::get('constant.tel1Statuses');
      $Phases = \Config::get('constant.tel1Phases');
      $Potentials = \Config::get('constant.tel1Potentials');
      $Services = \Config::get('constant.tel1Services');
      //
      $thisYear = date("Y");
      $lastYear = date("Y",strtotime("-1 year"));
      $thisMonth = date("m");
      $lastMonth = date("m",strtotime("-1 month"));

      $inqStatuses = [
        ['Status' => 'Inquiry', 'Field' => 'tel1DateInquiry'],
        ['Status' => 'Submit', 'Field' => 'tel1DateSubmit'],
        ['Status' => 'Hold', 'Field' => 'tel1DateHold'],
        ['Status' => 'Turndown', 'Field' => 'tel1DateTurndown'],
        ['Status' => 'Award', 'Field' => 'tel1DateAward'],
        ['Status' => 'Complete', 'Field' => 'tel1DateComplete'],
      ];

      foreach($inqStatuses as $inqStatus){

        // Tender quantity analysis
        $inqField = $inqStatus['Field'];
        $inqStatement = "YEAR($inqField) as year, MONTH($inqField) as month";
        $inqQty = DB::table("tel1s")
        ->select(DB::raw($inqStatement),DB::raw('count(*) as count'))
        ->groupBy('year','month')
        ->whereNotNull($inqField)
        ->get();

        $qtySoFar[$inqStatus['Status']] = $inqQty->sum('count');
        $qtyLastYear[$inqStatus['Status']] = $inqQty->where('year', $lastYear)->sum('count');
        $qtyThisYear[$inqStatus['Status']] = $inqQty->where('year', $thisYear)->sum('count');
        $qtyLastMonth[$inqStatus['Status']] = $inqQty->where('year', $thisYear)->where('month',$lastMonth)->sum('count');
        $qtyThisMonth[$inqStatus['Status']] = $inqQty->where('year', $thisYear)->where('month',$thisMonth)->sum('count');

        // Tender price analysis
        $inqField = $inqStatus['Field'];
        $inqStatement = "YEAR($inqField) as year, MONTH($inqField) as month";
        $PricebyMonth = DB::table("tel1s")
        ->select(DB::raw($inqStatement),DB::raw("SUM(tel1PriceTHB) as sum"))
        ->groupBy('year','month')
        ->whereNotNull($inqField)
        ->get();

        $prcSoFar[$inqStatus['Status']]  = $PricebyMonth->sum('sum');
        $prcLastYear[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->sum('sum');
        $prcThisYear[$inqStatus['Status']]  = $PricebyMonth->where('year', $thisYear)->sum('sum');
        $prcLastMonth[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->where('month', $lastMonth)->sum('sum');
        $prcThisMonth[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->where('month', $thisMonth)->sum('sum');

      }

      $dataQty = [$qtySoFar, $qtyLastYear, $qtyThisYear, $qtyLastMonth, $qtyThisMonth];
      $dataQtyInquiry =array_prepend(array_pluck($dataQty, 'Inquiry'),'Inquiry');
      $dataQtySubmit = array_prepend(array_pluck($dataQty, 'Submit'),'Submit');
      $dataQtyTurndown = array_prepend(array_pluck($dataQty, 'Turndown'),'Turndown');
      $dataQtyHold = array_prepend(array_pluck($dataQty, 'Hold'),'Hold');
      $dataQtyAward = array_prepend(array_pluck($dataQty, 'Award'),'Award');
      $dataQtyComplete = array_prepend(array_pluck($dataQty, 'Complete'),'Complete');
      $dataQty = [$dataQtyInquiry, $dataQtySubmit, $dataQtyTurndown, $dataQtyHold, $dataQtyAward, $dataQtyComplete];

      $dataPrice = [$prcSoFar, $prcLastYear, $prcThisYear, $prcLastMonth, $prcThisMonth];
      $dataPriceInquiry =array_prepend(array_pluck($dataPrice, 'Inquiry'),'Inquiry');
      $dataPriceSubmit = array_prepend(array_pluck($dataPrice, 'Submit'),'Submit');
      $dataPriceTurndown = array_prepend(array_pluck($dataPrice, 'Turndown'),'Turndown');
      $dataPriceHold = array_prepend(array_pluck($dataPrice, 'Hold'),'Hold');
      $dataPriceAward = array_prepend(array_pluck($dataPrice, 'Award'),'Award');
      $dataPriceComplete = array_prepend(array_pluck($dataPrice, 'Complete'),'Complete');
      $dataPrice = [$dataPriceInquiry, $dataPriceSubmit, $dataPriceTurndown, $dataPriceHold, $dataPriceAward, $dataPriceComplete];

      // dd($dataQty,$dataPrice);

      return view('pages.te.l1.tenderbyStatus', compact('dataQty','dataPrice'));
    }

    public function tel1TenderbyPotential()
    {

      // Prospect value an
      $Potentials = \Config::get('constant.tel1Potentials');

      $dateEstablish = Carbon::createFromDate(2015, 1, 1);
      $dateStart = Carbon::createFromDate(2017, 5, 21);
      $dateEnd = Carbon::createFromDate(2015, 12, 31);
      $dateToday = Carbon::today();


      $proActive = DB::table("tel1s")
      ->whereBetween('tel1DateSubmit', [$dateEstablish,$dateToday])
      ->whereNull('tel1DateTurnDown')
      ->whereNull('tel1DateAward')
      ->whereNull('tel1DateComplete')
      ->whereNotNull('tel1Potential')
      ->whereNotNull('tel1DateSubmit')
      ->get()
      ->pluck('tel1Number');

      // dd($proActive);

      //Create list of loop to be analyzed since July 2015
      $dateEst = "2015-07-01";
      $dateToday = date("Y-m-d");
      $dateEnd = $dateEst;
      $dateTargets = array();

      do{

        $dateEnd = date("Y-m-t", strtotime($dateEnd));
        array_push($dateTargets, $dateEnd);
        $dateEnd = date("Y-m-t", strtotime($dateEnd) + 24*60*60);
        // dd($dateTarget);

      } while($dateToday > $dateEnd);
      array_push($dateTargets, $dateEnd);

      // dd($dateEnd, $dateTargets);

      // $dateTargets=array(date("Y/m/d"));

      //Tender quantity by potential
      $dataQtyPotential = array();
      foreach($dateTargets as $dateTarget){


        $proQtyAll = DB::table("tel1s")
        ->whereNotNull('tel1Potential')
        ->whereBetween('tel1DateInquiry', [$dateEstablish,$dateTarget])
        ->select(DB::raw("tel1Potential as potential"),DB::raw('count(*) as count'))
        ->groupBy('potential')
        ->get()
        ->pluck('count','potential');

        $proQtyTurndown = DB::table("tel1s")
        ->whereBetween('tel1DateTurnDown', [$dateEstablish,$dateTarget])
        ->whereNotNull('tel1Potential')
        ->select(DB::raw("tel1Potential as potential"),DB::raw('count(*) as count'))
        ->groupBy('potential')
        ->get()
        ->pluck('count','potential');

        $proQtyAward = DB::table("tel1s")
        ->whereBetween('tel1DateAward', [$dateEstablish,$dateTarget])
        ->whereNotNull('tel1Potential')
        ->select(DB::raw("tel1Potential as potential"),DB::raw('count(*) as count'))
        ->groupBy('potential')
        ->get()
        ->pluck('count','potential');

        $proQtyHold = DB::table("tel1s")
        ->whereBetween('tel1DateHold', [$dateEstablish,$dateTarget])
        ->whereNotNull('tel1Potential')
        ->select(DB::raw("tel1Potential as potential"),DB::raw('count(*) as count'))
        ->groupBy('potential')
        ->get()
        ->pluck('count','potential');

        // dd($proQtyAll, $proQtyTurndown, $proQtyAward);

        foreach($Potentials as $Potential){

          if(isset($proQtyAll[$Potential])){
            $qtyAll[$Potential] = $proQtyAll[$Potential];
          }else{
            $qtyAll[$Potential] = 0;
          }

          if(isset($proQtyTurndown[$Potential])){
            $qtyTurnDown[$Potential] = $proQtyTurndown[$Potential];
          }else{
            $qtyTurnDown[$Potential] = 0;
          }

          if(isset($proQtyAward[$Potential])){
            $qtyAward[$Potential] = $proQtyAward[$Potential];
          }else{
            $qtyAward[$Potential] = 0;
          }

          if(isset($proQtyHold[$Potential])){
            $qtyHold[$Potential] = $proQtyHold[$Potential];
          }else{
            $qtyHold[$Potential] = 0;
          }


          $qtySum[$Potential] = $qtyAll[$Potential] - $qtyTurnDown[$Potential] - $qtyAward[$Potential] - $qtyHold[$Potential];

        }

        $qtySumAll = $qtySum['High'] + $qtySum['Medium'] + $qtySum['Low'] + $qtySum['Very low'];

        $temp = [
          'Date'=>$dateTarget,
          'High'=>$qtySum['High'],
          'Medium'=>$qtySum['Medium'],
          'Low'=>$qtySum['Low'],
          'Very low'=> $qtySum['Very low'],
          'Sum' => $qtySumAll,
        ];

        // dd($temp);

        array_push($dataQtyPotential, $temp);

      };

      $dataQtyPotentials = [$dataQtyPotential[33], $dataQtyPotential[34], $dataQtyPotential[35], $dataQtyPotential[36], $dataQtyPotential[37]];

      $dataQtyHigh =array_prepend(array_pluck($dataQtyPotentials, 'High'),'High');
      $dataQtyMedium =array_prepend(array_pluck($dataQtyPotentials, 'Medium'),'Medium');
      $dataQtyLow =array_prepend(array_pluck($dataQtyPotentials, 'Low'),'Low');
      $dataQtyVerylow =array_prepend(array_pluck($dataQtyPotentials, 'Very low'),'Very low');
      $dataQtySum =array_prepend(array_pluck($dataQtyPotentials, 'Sum'),'Sum');
      $dataQtyPotential = [$dataQtyHigh, $dataQtyMedium, $dataQtyLow, $dataQtyVerylow,$dataQtySum];



      //Tender Price by Potential
      $dataPrcPotential = array();
      $dataFactorPrcPotential = array();
      // dd($dateTargets);

      foreach($dateTargets as $dateTarget){

        $proPrcAll = DB::table("tel1s")
        ->whereNotNull('tel1Potential')
        ->whereBetween('tel1DateInquiry', [$dateEstablish,$dateTarget])
        ->select(DB::raw("tel1Potential as potential"),DB::raw('sum(tel1PriceTHB) as sum'))
        ->groupBy('potential')
        ->get()
        ->pluck('sum','potential');

        $proPrcTurndown = DB::table("tel1s")
        ->whereBetween('tel1DateTurnDown', [$dateEstablish,$dateTarget])
        ->whereNotNull('tel1Potential')
        ->select(DB::raw("tel1Potential as potential"),DB::raw('sum(tel1PriceTHB) as sum'))
        ->groupBy('potential')
        ->get()
        ->pluck('sum','potential');

        $proPrcAward = DB::table("tel1s")
        ->whereBetween('tel1DateAward', [$dateEstablish,$dateTarget])
        ->whereNotNull('tel1Potential')
        ->select(DB::raw("tel1Potential as potential"),DB::raw('sum(tel1PriceTHB) as sum'))
        ->groupBy('potential')
        ->get()
        ->pluck('sum','potential');

        $proPrcHold = DB::table("tel1s")
        ->whereBetween('tel1DateHold', [$dateEstablish,$dateTarget])
        ->whereNotNull('tel1Potential')
        ->select(DB::raw("tel1Potential as potential"),DB::raw('sum(tel1PriceTHB) as sum'))
        ->groupBy('potential')
        ->get()
        ->pluck('sum','potential');

        // dd($proPrcAll, $proPrcTurndown, $proPrcAward,$proPrcHold);

        foreach($Potentials as $Potential){

          if(isset($proPrcAll[$Potential])){
            $prcAll[$Potential] = $proPrcAll[$Potential];
          }else{
            $prcAll[$Potential] = 0;
          }

          if(isset($proPrcTurndown[$Potential])){
            $prcTurnDown[$Potential] = $proPrcTurndown[$Potential];
          }else{
            $prcTurnDown[$Potential] = 0;
          }

          if(isset($proPrcAward[$Potential])){
            $prcAward[$Potential] = $proPrcAward[$Potential];
          }else{
            $prcAward[$Potential] = 0;
          }

          // if(isset($proPrcHold[$Potential])){
          //   $prcHold[$Potential] = $proPrcHold[$Potential];
          // }else{
          //   $prcHold[$Potential] = 0;
          // }


          // $prcSum[$Potential] = $prcAll[$Potential] - $prcTurnDown[$Potential] - $prcAward[$Potential] - $prcHold[$Potential];
          $prcSum[$Potential] = $prcAll[$Potential] - $prcTurnDown[$Potential] - $prcAward[$Potential];

        }

        $prcSumAll = $prcSum['High'] + $prcSum['Medium'] + $prcSum['Low'] + $prcSum['Very low'];

        $temp = [
          'Date'=>$dateTarget,
          'High'=>$prcSum['High'],
          'Medium'=>$prcSum['Medium'],
          'Low'=>$prcSum['Low'],
          'Very low'=> $prcSum['Very low'],
          'Sum' => $prcSumAll,
        ];

        array_push($dataPrcPotential, $temp);

        $prcFactorHigh = $prcSum['High']*0.35;
        $prcFactorMedium = $prcSum['Medium']*0.10;
        $prcFactorLow = $prcSum['Low']*0.05;
        $prcFactorSumAll = $prcFactorHigh + $prcFactorMedium + $prcFactorLow;

        $temp = [
          'Date'=>$dateTarget,
          'High'=>$prcFactorHigh,
          'Medium'=>$prcFactorMedium,
          'Low'=>$prcFactorLow,
          'Sum' => $prcFactorSumAll,
        ];

        array_push($dataFactorPrcPotential, $temp);

      };

      // dd($dataPrcPotential);
      $size = count($dataPrcPotential);
      // dd($size);
      // dd($dataPrcPotential,$dataFactorPrcPotential);
      // dd(array_pluck($dataPrcPotential,'Sum'));
      $factorPrcPotentials = array_pluck($dataFactorPrcPotential,'Sum');


      $dataPrcPotentials = [$dataPrcPotential[$size-5], $dataPrcPotential[$size-4], $dataPrcPotential[$size-3], $dataPrcPotential[$size-2], $dataPrcPotential[$size-1]];

      $dataPrcHigh =array_prepend(array_pluck($dataPrcPotentials, 'High'),'High');
      $dataPrcMedium =array_prepend(array_pluck($dataPrcPotentials, 'Medium'),'Medium');
      $dataPrcLow =array_prepend(array_pluck($dataPrcPotentials, 'Low'),'Low');
      $dataPrcVerylow =array_prepend(array_pluck($dataPrcPotentials, 'Very low'),'Very low');
      $dataPrcSum =array_prepend(array_pluck($dataPrcPotentials, 'Sum'),'Sum');
      $dataPrcPotential = [$dataPrcHigh, $dataPrcMedium, $dataPrcLow, $dataPrcVerylow,$dataPrcSum];

      $dataFactorPrcPotentials = [$dataFactorPrcPotential[$size-5], $dataFactorPrcPotential[$size-4], $dataFactorPrcPotential[$size-3], $dataFactorPrcPotential[$size-2], $dataFactorPrcPotential[$size-1]];

      $dataFactorPrcHigh =array_prepend(array_pluck($dataFactorPrcPotentials, 'High'),'High');
      $dataFactorPrcMedium =array_prepend(array_pluck($dataFactorPrcPotentials, 'Medium'),'Medium');
      $dataFactorPrcLow =array_prepend(array_pluck($dataFactorPrcPotentials, 'Low'),'Low');
      $dataFactorPrcSum =array_prepend(array_pluck($dataFactorPrcPotentials, 'Sum'),'Sum');
      $dataFactorPrcPotential = [$dataFactorPrcHigh, $dataFactorPrcMedium, $dataFactorPrcLow,$dataFactorPrcSum];

      // dd($dataPrcPotential,$dataFactorPrcPotential);

      // $datePresent = array();
      foreach ($dateTargets as $dateTarget) {
        $X[] = date("M-y",strtotime($dateTarget));
      }

      foreach ($factorPrcPotentials as $factorPrcPotential) {
        $Y[] = $factorPrcPotential/1000000;
      }

      // dd($datePresent);

      $chart = new SampleChart;
      $chart->labels(array_slice($X,$size-23,$size));
      $chart->dataset('Factor prospect history (Million THB)', 'bar', array_slice($Y,$size-23,$size))->color('blue')->fill('blue');
      // $chart->dataset('My dataset', 'bar', $plot,'stack=1');
      return view('pages.te.l1.tenderbyPotential', compact('dataQtyPotential','dataPrcPotential','dataFactorPrcPotential','chart'));



    }

    public function tel1TenderAward()
    {

      $dateEst = "2015-01-01";
      $dateToday = date("Y-m-d");
      $dateEnd = $dateEst;
      $dateTargets = array();

      do{

        $dateEnd = date("Y-m-t", strtotime($dateEnd));
        array_push($dateTargets, $dateEnd);
        $dateEnd = date("Y-m-t", strtotime($dateEnd) + 24*60*60);

      } while($dateToday > $dateEnd);

      array_push($dateTargets, $dateEnd);

      foreach($dateTargets as $dateTarget){

        $dateStart = date("Y-m-d", strtotime($dateTarget) - 365*24*60*60);

        $proQtyAward = DB::table("tel1s")
        ->whereBetween('tel1DateAward', [$dateStart,$dateTarget])
        ->get()
        ->count('count');

        $dataQtyAwards[$dateTarget] = $proQtyAward;

        // dd($proQtyAward);

        $proPrcAward = DB::table("tel1s")
        ->whereBetween('tel1DateAward', [$dateStart,$dateTarget])
        ->get()
        ->sum('tel1PriceTHB');

        $dataPrcAwards[$dateTarget] = $proPrcAward;

      }

      // dd($dataQtyAwards,$dataPrcAwards);

      foreach ($dateTargets as $dateTarget) {
        $Xch1[] = date("M-y",strtotime($dateTarget));
      }

      foreach ($dataPrcAwards as $dataPrcAward) {
        $Ych1[] = $dataPrcAward/1000000;
      }

      // dd($Y);
      // dd($datePresent);

      $size = count($Xch1);

      $ch1a = new SampleChart;
      $ch1a->labels(array_slice($Xch1,$size-24,$size));
      $ch1a->dataset('Cumulative award for last 24 months (Million THB)', 'bar', array_slice($Ych1,$size-24,$size))->color('SteelBlue')->fill('SteelBlue');

      $ch1b  = new SampleChart;
      $ch1b->labels(array_slice($Xch1,0,$size));
      $ch1b->dataset('Cumulative work award since estalbish (Million THB)', 'bar', array_slice($Ych1,0,$size))->color('SteelBlue')->fill('SteelBlue');

      // Chart 2
      // dd($dateTargets);
      foreach($dateTargets as $dateTarget){

        $yearCurrent = substr($dateTarget, 0, 4);
        $dateStart = date('Y-m-d', strtotime('first day of January '.date($yearCurrent) ));

        $proPrcYrAwards[$yearCurrent][$dateTarget] = DB::table("tel1s")
        ->whereBetween('tel1DateAward', [$dateStart,$dateTarget])
        ->sum('tel1PriceTHB');

      }

      // dd($proPrcYrAwards);

      for ($i=1; $i < 13 ; $i++) {
        $Xch2[] = $i;
      }

      $i = 2015;
      foreach ($proPrcYrAwards as $proPrcYrAward) {

        $temp = array_values($proPrcYrAward);

        foreach ($temp as $temp) {
          $Ych2[$i][] = $temp/1000000;
        }

        $i = $i+1;
        // $Ych2[] = foreach( $Ych2 as &$val ){ $val *= 1000; }
      }

      // dd($Ych2);

      $ch2a = new SampleChart;
      $ch2a->labels($Xch2);

      $colorset = ['Magenta', 'Crimson', 'Coral', 'Yellow', 'Limegreen', 'Aqua', 'SteelBlue','DarkGoldenRod', 'DarkGray'];
      $i = 0;

      foreach ($Ych2 as $Ych2) {

        $ch2a->dataset(2015+$i, 'line', array_values($Ych2))->fill(false)->color($colorset[$i]);
        $i = $i+1;

      }

      return view('pages.te.l1.tenderAward', compact('ch1a','ch2a'));
    }


    public function tel1TenderManpower()
    {

      //Create data ragne for analysis

      $dateEst = "2016-01-01";
      // $dateEst = "2018-09-01";
      $dateToday = date("Y-m-d");
      $dateToday = date("Y-m-d",strtotime("+3 months", strtotime($dateToday)));
      // dd($dateToday);
      $dateEnd = $dateEst;
      $dateTargets = array();

      do{

        $dateEnd = date("Y-m-t", strtotime($dateEnd));
        array_push($dateTargets, $dateEnd);
        $dateEnd = date("Y-m-t", strtotime($dateEnd) + 24*60*60);

      } while($dateToday > $dateEnd);

      array_push($dateTargets, $dateEnd);

      // dd($dateTargets);

      //Manpower by month
      foreach ($dateTargets as $dateTarget) {

        $dateStart = date('Y-m-01',strtotime($dateTarget));
        $year = date('Y',strtotime($dateTarget));
        $month = date('m',strtotime($dateTarget));
        // dd($year, $month);

        $workingDay =  $this->countDays($year, $month, array(0, 6));
        // dd($workingDay);

        $activeStaffs = DB::table("hrl1s")
        ->where('hrl1DateStart','<',$dateStart)
        ->get();
        // dd($activeStaffs);

        $activeHours = 0;
        $totalActiveHours = 0;

        foreach($activeStaffs as $activeStaff){
          $factor = $this->staffActivity($activeStaff->hrl1Category);
          $activeHours = $activeHours + $factor*$workingDay*8;

          $factor1 = $this->staffActivity1($activeStaff->hrl1Category);
          $totalActiveHours = $totalActiveHours + $factor1*$workingDay*8;

        }


        $inActiveStaffs = DB::table("hrl1s")
        ->where('hrl1DateEnd','<',$dateStart)
        ->get();

        $inActiveHours = 0;
        $totalInactiveHours = 0;

        foreach($inActiveStaffs as $inActiveStaff){
          $factor = $this->staffActivity($inActiveStaff->hrl1Category);
          $inActiveHours = $inActiveHours + $factor*$workingDay*8;

          $factor1 = $this->staffActivity1($activeStaff->hrl1Category);
          $totalInactiveHours = $totalInactiveHours + $factor1*$workingDay*8;


        }

        $effectiveHours[$dateTarget] = $activeHours - $inActiveHours;
        $totalHours[$dateTarget] =  $totalActiveHours - $totalInactiveHours;

        // dd($activeHours,$inActiveHours);
        // dd($effectiveHours, $totalHours);

      }
      // dd($activeHours,$inActiveHours,$effectiveHours,$workingDay,$temp1,$temp2);

      //Power consumes by month
      foreach ($dateTargets as $dateTarget) {

        $dateStart = date('Y-m-01',strtotime($dateTarget));

        $proProspects = DB::table("tel1s")
        ->whereNotNull('tel1FcDateStart')
        ->whereNotNull('tel1FcDateFinish')
        ->whereNotNull('tel1FcManPower')
        ->where('tel1FcDateStart','<', $dateTarget)
        ->where('tel1FcDateFinish','>', $dateStart)
        ->whereNull('tel1DateAward')
        ->get();

        // $proAll = $proQuery->get();
        // $proProspects = $proQuery1->get();


        $hourProspect = 0;
        foreach ($proProspects as $proProspect) {

          // dd($proActive);
          if ($proProspect->tel1FcDateStart < $dateStart) {
            $dayStart = $dateStart;
          }else{
            $dayStart = $proProspect->tel1FcDateStart;
          }

          if ($proProspect->tel1FcDateFinish > $dateTarget) {
            $dayEnd = $dateTarget;
          }else{
            $dayEnd = $proProspect->tel1FcDateFinish;
          }

          $dayActive = $this->countWorkingDays($dayStart, $dayEnd);
          $manPower = $proProspect->tel1FcManPower;
          $tenderFactor = $this->tenderFactor($proProspect->tel1Potential);
          $hourProspect = $hourProspect + $dayActive * $manPower * 8 * $tenderFactor;
        }

        if ($dateTarget < date("Y-m-d")) {
          $hourProspects[$dateTarget] = 0;
        }else{
          $hourProspects[$dateTarget] = $hourProspect;
        }

        $proAwards = DB::table("tel1s")
        ->whereNotNull('tel1FcDateStart')
        ->whereNotNull('tel1FcDateFinish')
        ->whereNotNull('tel1FcManPower')
        ->where('tel1FcDateStart','<', $dateTarget)
        ->where('tel1FcDateFinish','>', $dateStart)
        ->whereNotNull('tel1DateAward')
        ->where('tel1DateAward','<',$dateTarget)
        ->get();

        $hourAward = 0;

        // dd($dateStart, $proAwards);

        foreach ($proAwards as $proAward) {

          // dd($proActive);
          if ($proAward->tel1FcDateStart < $dateStart) {
            $dayStart = $dateStart;
          }else{
            $dayStart = $proAward->tel1FcDateStart;
          }

          if ($proAward->tel1FcDateFinish > $dateTarget) {
            $dayEnd = $dateTarget;
          }else{
            $dayEnd = $proAward->tel1FcDateFinish;
          }

          $dayActive = $this->countWorkingDays($dayStart, $dayEnd);
          $manPower = $proAward->tel1FcManPower;
          $hourAward = $hourAward + $dayActive * $manPower * 8;

          // dd($dayStart, $dayEnd, $dayActive, $hourActive);
        }

        $hourAwards[$dateTarget] = $hourAward;

      }

      $hourCombine = array();
      foreach (array_keys($hourProspects + $hourAwards) as $key) {
          $hourCombine[$key] = (isset($hourProspects[$key]) ? $hourProspects[$key] : 0) + (isset($hourAwards[$key]) ? $hourAwards[$key] : 0);
      }

      // dd($hourCombine);

      // Make Chart

      // $Xch1s = array_keys($effectiveHours);

      $size = count($dateTargets);

      foreach ($dateTargets as $dateTarget) {
        $Xch1[] = date("M-y",strtotime($dateTarget));
      }
      // dd($Xch1);

      $range = 15;

      $Xch1 = array_slice($Xch1, $size-$range, $size);
      $Ych1 = array_slice(array_values($effectiveHours), $size-$range, $size);
      $Ych2 = array_slice(array_values($totalHours), $size-$range, $size);
      $Ych3 = array_slice(array_values($hourAwards), $size-$range, $size);
      $Ych4 = array_slice(array_values($hourCombine), $size-$range, $size);

      // dd($Ych1);


      $ch1a = new SampleChart;
      $ch1a->labels($Xch1);
      $ch1a->dataset("Avaiable man power", 'line', $Ych1)->fill(false)->color('SteelBlue');
      $ch1a->dataset("Total man power", 'line', $Ych2)->fill(false)->color('Blue');
      $ch1a->dataset("Required manpower", 'line', $Ych3)->fill(false)->color('red');
      $ch1a->dataset("Required + provision manpower", 'line', $Ych4)->fill(false)->color('green');


      return view('pages.te.l1.tenderManPower', compact('ch1a'));

    }

    function staffActivity($category){

      $activity = 0;

      if ($category == 'Management 1') {
        $activity = 0.50;
      }elseif ($category == 'Management 2') {
        $activity = 0.50;
      }elseif ($category == 'Project management'){
        $activity = 0.75;
      }elseif ($category == 'Professional'){
        $activity = 0.85;
      }elseif ($category == 'Technical'){
        $activity = 0.85;
      }

      return $activity;

    }

    function staffActivity1($category){

      $activity = 0;

      if ($category == 'Management 1') {
        $activity = 1.0;
      }elseif ($category == 'Management 2') {
        $activity = 1.0;
      }elseif ($category == 'Project management'){
        $activity = 1.0;
      }elseif ($category == 'Professional'){
        $activity = 1.0;
      }elseif ($category == 'Technical'){
        $activity = 1.0;
      }

      return $activity;

    }

    function tenderFactor($potential){

      $tenderFactor= 0;

      if ($potential == 'High') {
        $tenderFactor = 0.35;
      }elseif ($potential == 'Medium') {
        $tenderFactor = 0.10;
      }elseif ($potential == 'Low'){
        $tenderFactor = 0.05;
      }

      return $tenderFactor;

    }

    function countDays($year, $month, $ignore) {
    $count = 0;
    $counter = mktime(0, 0, 0, $month, 1, $year);
    while (date("n", $counter) == $month) {
        if (in_array(date("w", $counter), $ignore) == false) {
            $count++;
        }
        $counter = strtotime("+1 day", $counter);
    }
    return $count;
}

function countWorkingDays($from, $to) {
    $workingDays = [1, 2, 3, 4, 5];         // Working days (week days)
    $holidayDays =
    [
      '*-01-01',
      '*-04-13',
      '*-04-14',
      '*-04-15',
      '*-05-01',
      '*-12-31',
    ];  // Holidays array, add desired dates to this array

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
      if (!in_array($period->format('N'), $workingDays)) continue;
      if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
      if (in_array($period->format('*-m-d'), $holidayDays)) continue;
      $days++;
  }
  return $days;
}

}
