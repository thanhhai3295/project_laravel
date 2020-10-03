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


Route::group(['prefix' => $prefixAdmin,'middleware' => ['permission.admin']], function () {
  // --------------- DASHBOARD ---------------
  $prefix = 'dashboard';
  $controllerName = 'dashboard';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($prefix);
  });
  // --------------- SLIDER ---------------
  $prefix = 'slider';
  $controllerName = 'slider';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
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
    $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
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
    $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($prefix);
    Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
    Route::post('save',$controller.'save')->name($controllerName.'/save');
    Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
    Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    Route::get('change-type-{type}/{id}',$controller.'type')->where('id','[0-9]+')->name($controllerName.'/type');
  });
  // --------------- USER ---------------
  $prefix = 'user';
  $controllerName = 'user';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\admin\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($prefix);
    Route::get('form/{id?}',$controller.'form')->where('id','[0-9]+')->name($controllerName.'/form');
    Route::post('save',$controller.'save')->name($controllerName.'/save');
    Route::get('delete/{id}',$controller.'delete')->where('id','[0-9]+')->name($controllerName.'/delete');
    Route::get('change-status-{status}/{id}',$controller.'status')->where('id','[0-9]+')->name($controllerName.'/status');
    Route::get('change-level-{level}/{id}',$controller.'level')->where('id','[0-9]+')->name($controllerName.'/level');
    Route::post('change-level',$controller.'level')->where('id','[0-9]+')->name($controllerName.'/change-level');
    Route::post('change-password',$controller.'change_password')->name($controllerName.'/change-password');
  });

});


Route::group(['prefix' => $prefixNews], function () {
  // --------------- DASHBOARD ---------------
  $prefix = '';
  $controllerName = 'home';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
    Route::get('/',$controller.'index')->name($controllerName);
  });

  // --------------- CATEGORY ---------------
  $prefix = 'chuyen-muc';
  $controllerName = 'category';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
    Route::get('/{category_name}-{category_id}.html',$controller.'index')->where('category_id','[0-9]+')->where('category_name','[0-9A-Za-z_-]+')->name($controllerName.'/index');
  });

  // --------------- ARTICLE ---------------
  $prefix = 'bai-viet';
  $controllerName = 'article';
  Route::group(['prefix' => $prefix], function () use($prefix,$controllerName) {
    $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
    Route::get('/{article_name}-{article_id}.html',$controller.'index')->where('article_id','[0-9]+')->where('article_name','[0-9A-Za-z_-]+')->name($controllerName.'/index');
  });

  // ====================== LOGIN ========================
    // news69/login
    $prefix         = '';
    $controllerName = 'auth';
    
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
        Route::get('/login',$controller.'login')->name($controllerName.'/login')->middleware('check.login');

        Route::post('/postLogin',$controller.'postLogin')->name($controllerName.'/postLogin');

        // ====================== LOGOUT ========================
        Route::get('/logout',$controller.'logout')->name($controllerName.'/logout');
    });

    $prefix         = '';
    $controllerName = 'notify';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = 'App\Http\Controllers\News\\'.ucfirst($controllerName).'Controller@';
        Route::get('/no-permission',$controller.'noPermission')->name($controllerName.'/noPermission');
    });

});