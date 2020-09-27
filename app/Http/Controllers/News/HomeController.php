<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as SliderModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
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
      $articleModel = new ArticleModel();
      $itemSlider = $sliderModel->listItems(null,['task' => 'news-list-items']);
      $itemsCategory = $categoryModel->listItems(null,['task' => 'news-list-items-is-home']);
      foreach ($itemsCategory as $key => $value) {
        $itemsCategory[$key]['article'] = $articleModel->listItems(['category_id' => $value['id']],['task' => 'news-list-items-in-category']);
      }
      $itemsFeature = $articleModel->listItems(null,['task' => 'news-list-items-feature']);
      $itemsLastest = $articleModel->listItems(null,['task' => 'news-list-items-lastest']);
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'itemSlider' => $itemSlider,
        'itemsCategory' => $itemsCategory,
        'itemsFeature' => $itemsFeature,
        'itemsLastest' => $itemsLastest
      ]);
    }
    
}