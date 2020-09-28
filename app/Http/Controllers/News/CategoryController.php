<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
class CategoryController extends Controller
{
    private $controllerName     = 'category';
    private $pathViewController = 'news.pages.category.';
    private $params             = [];
    public function __construct()
    {
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $params['category_id'] = $request->category_id;
      $articleModel = new ArticleModel();
      $categoryModel = new CategoryModel();
      $itemsCategory = $categoryModel->getItem($params,['task' => 'news-get-items']);
      if(!($itemsCategory)) return redirect()->route('home');
      $itemsLastest = $articleModel->listItems(null,['task' => 'news-list-items-lastest']);
      $itemsCategory['article'] = $articleModel->listItems(['category_id' => $params['category_id']],['task' => 'news-list-items-in-category']);
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'itemsLastest' => $itemsLastest,
        'itemsCategory' => $itemsCategory
      ]);
    }
    
}