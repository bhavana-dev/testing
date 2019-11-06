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

Route::get('/admin/user/roles',['middleware' => ['auth','web'], function (){
	return  "middleware roles";
}]);

Route::get('/home', 'HomeController@index');
Route::get('/javascript', 'HomeController@Javascript');
Route::get('/admin', 'AdminController@index');
Route::get('/create/form', array('as'=>'create.form','uses' =>'HomeController@createForm'));
//map related routes
Route::get('/show/map', array('as'=>'show.map','uses' =>'MapController@loadView'));


// Route::get('/api_test', 'HomeController@test');

//(created by bhavana) route for moving marker between two points 
Route::get('/get/direction', 'HomeController@GetDirection');

//(google example) route for moving marker between two points 
Route::get('/demoRoute', function(){
	return view("maps/demoRoute");
});

//(created by bhavana) route for showing suggation with limited bound
Route::get('/autocomplete', function(){
	return view("maps/autocomplete");
});

//(created by bhavana) route for showing marker , cluster according to nearby change , drawing manager
Route::get('/api_test', function(){
	return view("maps/test_area");
});

