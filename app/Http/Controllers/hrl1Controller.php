<?php

namespace App\Http\Controllers;

use App\user;
use App\hrl1;
use App\hrl1Category;
use App\hrl1Position;

use Illuminate\Http\Request;

class hrl1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userHR = auth()->user()->userHR;
        $name = auth()->user()->name;

        if ($userHR >= 2)
        {
          $hrl1 = hrl1::all();
        }else{
          $hrl1 = hrl1::where('Name',$name)->get();
        }
        return view('pages.hr.l1.index', compact('hrl1','userHR'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        //
        $userHR = auth()->user()->userHR;
        $hrl1 = hrl1::where('name',$name)->first();
        $hrCategories = hrl1Category::all();
        $hrPositions = hrl1Position::all();
        $hrSupervisors = User::all();

        $hrRoles = \Config::get('constant.hrl1Roles');
        $hrDisciplines = \Config::get('constant.hrl1Disciplines');

        // $hrPosition = \Config::get('constant.hrPosition');
        // dd($hrl1);
        // dd($hrRole);

        return view('pages.hr.l1.edit', compact('hrl1','hrCategories','hrPositions','hrSupervisors','hrRoles','hrDisciplines','userHR'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name)
    {
        //

      // dd($request);
      $hrl1 = hrl1::where('name',$name)->first()->update($request->all());
      return redirect()->route('hrl1.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hrl1Export()
    {
      $hrl1s = hrl1::all();
      $csvExporter = new \Laracsv\Export();
      $csvExporter->build($hrl1s,[
        'name' => 'User name',
        'hrl1FirstName' => 'Employee first name',
        'hrl1LastName' => 'Employee last name',
        'hrl1Address' => 'Employee address',
        'hrl1Email' => 'Employee email',
        'hrl1Tel1' => 'Employee telephone number 1',
        'hrl1Tel1' => 'Employee telephone number 2',
        'hrl1BirthDate' => 'Employee birth day',
        'hrlThaiID' => 'Employee ID number',
        'hrl1EmeFirstName' => 'Employee emergycy contact first name',
        'hrl1EmeLastName' => 'Employee emergycy contact last name',
        'hrl1EmeAddress' => 'Employee emergycy contact address',
        'hrl1EmeEmail' => 'Employee emergycy contact email',
        'hrl1EmeTel1' => 'Employee emergycy contact telephone number 1',
        'hrl1EmeTel1' => 'Employee emergycy contact telephone number 2',
        'hrl1DateStart' => 'Employee service start date',
        'hrl1hrl1DateEnd' => 'Employee service end date',
        'hrl1Supervisor' => 'Employee supervisor',
        'hrl1Role1' => 'Employee role 1',
        'hrl1Role2' => 'Employee role 2',
        'hrl1Category' => 'Employee category',
        'hrl1Grade' => 'Employee grade',
        'hrl1Position' => 'Employee position',
        ])->download();
      // return redirect()->route('user.index');

    }
}
