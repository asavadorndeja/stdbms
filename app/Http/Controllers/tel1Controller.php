<?php

namespace App\Http\Controllers;
use App\user;
use App\tel1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function tel1Report()
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
        ->get();

        $prcSoFar[$inqStatus['Status']]  = $PricebyMonth->sum('sum');
        $prcLastYear[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->sum('sum');
        $prcThisYear[$inqStatus['Status']]  = $PricebyMonth->where('year', $thisYear)->sum('sum');
        $prcLastMonth[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->where('month', $lastMonth)->sum('sum');
        $prcThisMonth[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->where('month', $thisMonth)->sum('sum');

      }

      // dd($PricebyMonth);
      // dd($qtySoFar,$qtyLastYear,$qtyThisYear,$qtyLastMonth,$qtyThisMonth);
      // dd($prcSoFar,$prcLastYear,$prcThisYear,$prcLastMonth,$prcThisMonth);

      //Tender analysis by potentials

      $dateStart = Carbon::createFromDate(2017, 5, 21);
      $dateEnd = Carbon::createFromDate(2017, 6, 21);

      $inqPotentials = $Potentials;
      $inqTest = DB::table("tel1s")
      ->groupby('tel1Status')
      // ->whereBetween('tel1DateSubmit', [$dateStart,$dateEnd])
      // ->whereNotBetween('tel1DateTurndown', [$dateStart,$dateEnd]);
      ->get();

      // ->sum('tel1PriceTHB');

      dd($inqTest);


      foreach($inqPotentials as $inqPotential){

        // Tender potential analysis
        $inqStatement = "YEAR(tel1Pot) as year, MONTH($inqField) as month";
        $inqQty = DB::table("tel1s")
        ->groupBy('tel1Status')
        ->where('tel1Status', 'Inquiry')
        ->get();

      }
        // ->select(DB::raw($inqStatement),DB::raw('count(*) as count'))
        // ->groupBy('year','month')
        // ->get();
        //
        //
        // $qtySoFar[$inqStatus['Status']] = $inqQty->sum('count');
        // $qtyLastYear[$inqStatus['Status']] = $inqQty->where('year', $lastYear)->sum('count');
        // $qtyThisYear[$inqStatus['Status']] = $inqQty->where('year', $thisYear)->sum('count');
        // $qtyLastMonth[$inqStatus['Status']] = $inqQty->where('year', $thisYear)->where('month',$lastMonth)->sum('count');
        // $qtyThisMonth[$inqStatus['Status']] = $inqQty->where('year', $thisYear)->where('month',$thisMonth)->sum('count');
        //
        // // Tender price analysis
        // $inqField = $inqStatus['Field'];
        // $inqStatement = "YEAR($inqField) as year, MONTH($inqField) as month";
        // $PricebyMonth = DB::table("tel1s")
        // ->select(DB::raw($inqStatement),DB::raw("SUM(tel1PriceTHB) as sum"))
        // ->groupBy('year','month')
        // ->get();
        //
        // $prcSoFar[$inqStatus['Status']]  = $PricebyMonth->sum('sum');
        // $prcLastYear[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->sum('sum');
        // $prcThisYear[$inqStatus['Status']]  = $PricebyMonth->where('year', $thisYear)->sum('sum');
        // $prcLastMonth[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->where('month', $lastMonth)->sum('sum');
        // $prcThisMonth[$inqStatus['Status']]  = $PricebyMonth->where('year', $lastYear)->where('month', $thisMonth)->sum('sum');

      // }

      // dd($qtySoFar,$qtyLastYear,$qtyThisYear,$qtyLastMonth,$qtyThisMonth);
      // dd($prcSoFar,$prcLastYear,$prcThisYear,$prcLastMonth,$prcThisMonth);

      // $inqField = ["tel1DateInquiry","tel1DateSubmit","tel1DateHold","tel1DateTurnDown","tel1DateAward","tel1DateComplete"];
      //
      // for ($i=0; $i <=5; $i++){
      //
      //   $inqStatement = "YEAR($inqField[$i]) as year, MONTH(tel1DateInquiry) as month";
      //   $inqQty = DB::table("tel1s")
      //   ->select(DB::raw($inqStatement),DB::raw('count(*) as count'))
      //   ->groupBy('year','month')
      //   ->get();
      //
      //
      //   $qtySoFar[$i] = $inqQty->sum('count');
      //   $qtyLastYear[$i] = $inqQty->where('year', $lastYear)->where('month','>',0)->sum('count');
      //   $qtyThisYear[$i] = $inqQty->where('year', $thisYear)->where('month','>',0)->sum('count');
      //   $qtyLastMonth[$i] = $inqQty->where('year', $thisYear)->where('month',$lastMonth)->sum('count');
      //   $qtyThisMonth[$i] = $inqQty->where('year', $thisYear)->where('month',$thisMonth)->sum('count');
      //
      // }
      //
      // dd($qtySoFar,$qtyLastYear,$qtyThisYear,$qtyLastMonth,$qtyThisMonth);

      // Tender price analysis


      // $InqQtyByMonth = DB::table("tel1s")
      // ->select(DB::raw("YEAR(tel1DateInquiry) as year, MONTH(tel1DateInquiry) as month"),DB::raw('count(*) as count'))
      // ->groupBy('year','month')
      // ->get();
      //
      // $InqQtySoFar = $InqQtyByMonth->sum('count');
      // $InqQtyLastYear = $InqQtyByMonth->where('year', $lastYear)->where('month','>',0)->sum('count');
      // $InqQtyThisYear = $InqQtyByMonth->where('year', $thisYear)->where('month','>',0)->sum('count');
      // $InqQtyLastMonth = $InqQtyByMonth->where('year', $thisYear)->where('month',$lastMonth)->sum('count');
      // $InqQtyThisMonth = $InqQtyByMonth->where('year', $thisYear)->where('month',$thisMonth)->sum('count');
      //
      // dd($InqQtySoFar,$InqQtyLastYear,$InqQtyThisYear,$InqQtyLastMonth,$InqQtyThisMonth);
      //
      // $SubQtyByMonth = DB::table("tel1s")
      // ->select(DB::raw("YEAR(tel1DateSubmit) as year, MONTH(tel1DateSubmit) as month"),DB::raw('count(*) as count'))
      // ->groupBy('year','month')
      // ->get();
      //
      // $SubQtySoFar = $SubQtyByMonth->sum('count');
      // $SubQtyLastYear = $SubQtyByMonth->where('year', $lastYear)->sum('count');
      // $SubQtyThisYear = $SubQtyByMonth->where('year', $thisYear)->sum('count');
      // $SubQtyLastMonth = $SubQtyByMonth->where('year', $thisYear)->where('month',$lastMonth)->sum('count');
      // $SubQtyThisMonth = $SubQtyByMonth->where('year', $thisYear)->where('month',$thisMonth)->sum('count');
      //
      // dd($SubQtySoFar,$SubQtyLastYear,$SubQtyThisYear,$SubQtyLastMonth,$SubQtyThisMonth);
      //
      //
      // $PricebyMonth = DB::table("tel1s")
      // ->select(DB::raw("YEAR(tel1DateSubmit) as year, MONTH(tel1DateInquiry) as month, tel1Potential as Potential"),DB::raw("SUM(tel1PriceTHB) as sum"))
      // ->groupBy('year','month','Potential')
      // ->get();
      //
      // $priceSoFar = $PricebyMonth->sum('sum');
      // $priceLastYear = $PricebyMonth->where('year', $lastYear)->sum('sum');
      // $priceThisYear = $PricebyMonth->where('year', $thisYear)->sum('sum');
      // $priceLastMonth = $PricebyMonth->where('year', $lastYear)->where('month', $lastMonth)->sum('sum');
      // $priceThisMonth = $PricebyMonth->where('year', $lastYear)->where('month', $thisMonth)->sum('sum');



      // $tenderQtybyYear = DB::table("tel1s")
      // ->select(DB::raw('YEAR(tel1DateInquiry) as year,  , tel1Status as Status, count(*) as count'))
      // ->groupBy('year', 'status')
      // ->get();
      //
      //
      //
      // $qtyByStatus = [];
      // $i = 1;
      //
      // // dd($Phases);
      //
      //
      //
      //
      // foreach ($Statuses as $Status)
      // {
      //
      //   $qtyByStatus[$i][1] = $QtyByMonth->where('')->sum('count');
      //
      //   // $data[$i][$i] = $tePotential;
      //   $i = $i+1;
      // }
      //
      // dd($qtyByStatus);
      // dd($PricebyMonth,$priceSoFar,$priceLastYear,$priceThisYear,$priceLastMonth,$priceThisMonth);



      //
      // // $tenderQtythisYear = $tenderQtyMonth::where('year','2018')->get();
      //
      // // $a=array($tenderQtyYear);
      // // $b = array_sum($a);
      //
      // // $array = array_only($tenderQtyYear, ['year']);
      // // dd($array);
      // dd(  $test);
      //
      // $tenderQtyAll = DB::table("tel1s")
      // ->select('tel1Status', DB::raw('count(*) as count'))
      // ->groupBy('tel1Status')
      // ->pluck('count','tel1Status')->all();
      //


      // $tenderFullPriceSofar =  DB::table("tel1s")
      // ->select('tel1Status', DB::raw("SUM(tel1PriceTHB) as sum"))
	    // ->groupBy(DB::raw("tel1Status"))
	    // ->pluck('sum','tel1Status')->all();

      // $tenderQtybyYear = DB::table("tel1s")
      // ->select(DB::raw('YEAR(tel1DateInquiry) as year , tel1Status as Status, count(*) as count'))
      // ->groupBy('year', 'status')
      // ->get();


      // $tenderFactorPriceSofar =  DB::table("tel1s")
      // ->select(DB::raw('tel1Status as Status'), DB::raw('tel1Potential as Potential'),DB::raw("SUM(tel1PriceTHB) as sum"))
	    // ->groupBy(DB::raw("tel1Status"),DB::raw("tel1Potential"))
      // ->get()->toArray();
      //
      // $tenderQtybyYear = DB::table("tel1s")
      // ->select(DB::raw("YEAR(tel1DateInquiry) as year, MONTH(tel1DateInquiry) as month"),DB::raw('count(*) as count'))
      // ->groupBy('year','month')
      // ->get();

      // $tenderQtybyMonth = DB::table("tel1s")
      // ->select(DB::raw("YEAR(tel1DateInquiry) as year, MONTH(tel1DateInquiry) as month"),DB::raw('count(*) as count'))
      // ->groupBy('year','month')
      // ->get()->toArray();




      // $data = tel1::groupBy('tel1Status')->get();

      // $keys = array_keys($tenderQtySofar);
      // dd($keys[0]);
      // dd($tenderQtySofar,$tenderFullPriceSofar);
      // $showArray = array_merge_recursive($tenderQtySoAll,$tenderFullPriceSofar);
      // dd($showArray);
      // return view('pages.te.l1.report', compact('tenderQtySofar','tenderFullPriceSofar'));

      // // $tenderQtyYear = DB::table("tel1s")
      // // ->select(DB::raw("YEAR(tel1DateInquiry) as year"),DB::raw('count(*) as count'))
      // // ->groupBy('year')
      // // ->get()->toArray();
      //
      // // $test = DB::table("tel1s")->where(DB::raw("YEAR(tel1DateInquiry) = 2017"))->get();
      //



    }
}
