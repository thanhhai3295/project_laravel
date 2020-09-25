<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as SliderModel;
use App\Models\CategoryModel;
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
      $categoryModel = new CategoryModel();
      $itemSlider = $sliderModel->listItems(null,['task' => 'news-list-items']);
      $itemCategory = $categoryModel->listItems(null,['task' => 'news-list-items-is-home']);
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'itemSlider' => $itemSlider
        ,'itemCategory' => $itemCategory
      ]);
    }
    
}