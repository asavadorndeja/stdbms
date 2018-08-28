<?php

namespace App\Http\Controllers;

use App\hrl1;
use App\user;

use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      $users = user::all();
      // dd($users);
      return view('pages.user.index', compact('users'));
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
        // dd($username);
        return view('pages.user.create', compact('userName'));

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
        $this->validate(request(), [
          'name' => 'required',
          'email' => 'required',
          'password' => 'required',
        ]);

        user::create([
          'name'  => request('name'),
          'email' => request('email'),
          'password' => bcrypt(request('password')),
          'create_by' => auth()->user()->name,
        ]);

        hrl1::create([
          'name' => request('name'),
          'create_by' => auth()->user()->name,
        ]);

      return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
        // dd ($user);
        $levelRange = array(1,2,3);
        return view('pages.user.edit', compact('user','levelRange'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
        // dd($request, $user);

        $this->validate(request(), [
          'password' => 'required',
          'userAD' => 'required',
          'userTE' => 'required',
          'userPE' => 'required',
          'userOU' => 'required',
          'userDC' => 'required',
          'userHS' => 'required',
          'userHR' => 'required',
          'userMM' => 'required',
          'userQA' => 'required',
        ]);

        $user->update([
          'userAD' => request('userAD'),
          'userTE' => request('userTE'),
          'userPE' => request('userPE'),
          'userOU' => request('userOU'),
          'userDC' => request('userDC'),
          'userHS' => request('userHS'),
          'userHR' => request('userHR'),
          'userMM' => request('userMM'),
          'userQA' => request('userQA')
        ]);

        if (request('password') != $user->password){
          $user->update([
            'password' => bcrypt(request('password'))
          ]);
        }

        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
        // $user = user::find($id);
        // dd ($user);

        $user = user::find($user->id)->delete();
        $hrl1 = hrl1::where('name',$user->name)->delete();
        return redirect()->route('user.index');

    }

    public function userExport()
    {
      $users = user::all();
      $csvExporter = new \Laracsv\Export();
      $csvExporter->build($users,[])->download();
      // return redirect()->route('user.index');

    }

}
