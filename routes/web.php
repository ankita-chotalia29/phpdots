<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/cache-clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/','ClassController@index')->name('home');
Route::get('/add-class/{id?}','ClassController@create')->name('create');
Route::post('/store','ClassController@store')->name('store');
Route::post('/update/{id?}','ClassController@update')->name('update');
Route::delete('/destroy/{id?}','ClassController@destroy')->name('destroy');
Route::get('/download/{id?}','ClassController@download')->name('download');



