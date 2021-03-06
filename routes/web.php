<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/user/index', 'userController@index')

Route::resource('user','userController');
Route::get('/userExport', 'userController@userExport');

Route::resource('hrl1','hrl1Controller');
Route::get('/hrl1Export', 'hrl1Controller@hrl1Export');


Route::get('/api/StaffPosition/{empCategoryID}',function($hrl1Category)
{
   $hrl1Positions = App\hrl1Position::where('hrl1CategoryRef','=',$hrl1Category)->get();
  return Response::json($hrl1Positions);
});

Route::resource('tel1','tel1Controller');
Route::get('/tel1Export', 'tel1Controller@tel1Export');
Route::get('/tel1TenderbyStatus', 'tel1Controller@tel1TenderbyStatus');
Route::get('/tel1TenderbyPotential', 'tel1Controller@tel1TenderbyPotential');
Route::get('/tel1TenderAward', 'tel1Controller@tel1TenderAward');
Route::get('/tel1TenderManPower', 'tel1Controller@tel1TenderManPower');

// Route::resource('tel2','tel2Controller');


Route::resource('pel1','pel1Controller');

Route::resource('pel2','pel2Controller');
Route::get('/pel2Export', 'pel2Controller@pel2Export');

Route::resource('pel4','pel4Controller');
Route::get('/pel4IndexDelete', 'pel4Controller@indexDelete')->name('pel4.indexDelete');
Route::get('/pel4ExportUser', 'pel4Controller@pel4ExportUser');
Route::get('/pel4ExportAllUser', 'pel4Controller@pel4ExportAllUser');


Route::get('/api/pel2/{tel1ID}',function($tel1ID)
{
   $pel2s = App\pel2::where('tel1Number','=',$tel1ID)->get();
  return Response::json($pel2s);
});
