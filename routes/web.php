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
$prefixAdmin = Config::get('test.prefix_admin');
Route::get('/', function () {
    return view('home');
});
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
Route::group(['prefix' => $prefixAdmin], function () {
  // --------------- DASHBOARD ---------------
  $prefix = 'dashboard';
  $controllerName = 'dashboard';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($prefix);
  });
  // --------------- SLIDER ---------------
  $prefix = 'slider';
  $controllerName = 'slider';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($prefix);
    Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
    Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
    Route::get('change-status-{status}/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/status');
  });

});