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
$prefixAdmin = Config::get('zvn.url.prefix_admin');
$prefixNews  = Config::get('zvn.url.prefix_news');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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
    Route::post('save',$controller.'save')->name($controllerName.'/save');
    Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
    Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
  });
  // --------------- CATEGORY ---------------
  $prefix = 'category';
  $controllerName = 'category';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($prefix);
    Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
    Route::post('save',$controller.'save')->name($controllerName.'/save');
    Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
    Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    Route::get('change-is-home-{isHome}/{id}',$controller.'isHome')->where('id','[0-9]+')->name($controllerName.'/isHome');
    Route::get('change-display-{display}/{id}',$controller.'display')->where('id','[0-9]+')->name($controllerName.'/display');
  });
  // --------------- ARTICLE ---------------
  $prefix = 'article';
  $controllerName = 'article';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($prefix);
    Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
    Route::post('save',$controller.'save')->name($controllerName.'/save');
    Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
    Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    Route::get('change-type-{type}/{id}',$controller.'type')->where('id','[0-9]+')->name($controllerName.'/type');
  });
});


Route::group(['prefix' => $prefixNews], function () {
  // --------------- DASHBOARD ---------------
  $prefix = '';
  $controllerName = 'home';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($prefix);
  });
});