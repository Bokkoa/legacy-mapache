<?php

use App\Http\Controllers\Controller;

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




Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

//Si se esta logueado no se ve el login
Route::group(['middleware' => 'session'], function () {
    Route::get('/', function () { return view('auth.login'); });
    Route::post('', 'Auth\LoginController@login')->name('login');
});

Route::get('userprofile', 'UserController@userprofile')->name('profile');
Route::post('setimgprofile', 'UserController@setimgprofile');

Route::get('modules', 'ModuleController@modules');
Route::post('modules', 'ModuleController@moduleswithk');

Route::get('subjects', 'SubjectController@subjects');
Route::post('scrapsiiau', 'SubjectController@scrapsiiau');

//Solo si eres admin puedes entrar aqui
Route::group(['middleware' => 'admin'], function () {
    Route::get('adminmodules', 'ModuleController@index')->name('adminmodules'); 
    Route::post('editmodules', 'ModuleController@edit'); 
    Route::post('insertmodule', 'ModuleController@store'); 
    Route::post('deletemodule', 'ModuleController@destroy'); 

    Route::get('showcharts', 'UserController@showcharts'); 
    Route::get('getdataforchart', 'UserController@getdataforchart');

    Route::get('k-means', 'UserController@kmeans');
});

