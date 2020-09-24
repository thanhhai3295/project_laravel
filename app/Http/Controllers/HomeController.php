<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    private $model;
    private $controllerName     = 'home';
    private $pathViewController = 'news.pages.home.';
    private $params             = [];
    public function __construct()
    {
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      return view($this->pathViewController.'index',[
        'params' => $this->params,
      ]);
    }
    
}