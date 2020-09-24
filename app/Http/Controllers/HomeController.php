<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as SliderModel;
class HomeController extends Controller
{
    private $controllerName     = 'home';
    private $pathViewController = 'news.pages.home.';
    private $params             = [];
    public function __construct()
    {
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $sliderModel = new SliderModel();
      $itemSlider = $sliderModel->listItems(null,['task' => 'news-list-items']);
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'itemSlider' => $itemSlider
      ]);
    }
    
}