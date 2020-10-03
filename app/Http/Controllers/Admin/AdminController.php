<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    protected $model;
    protected $controllerName     = '';
    protected $pathViewController = '';
    protected $params             = [];
    public function __construct()
    {
      $this->params['pagination']['totalItemsPerPage'] = 4;
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $this->params['filter']['status'] = $request->input('filter_status','all');
      $this->params['filter']['category'] = $request->input('filter_category','');
      $this->params['filter']['type'] = $request->input('filter_type','');
      $this->params['search']['field'] = $request->input('search_field','');
      $this->params['search']['value'] = $request->input('search_value','');
      $items = $this->model->listItems($this->params,['task' => 'admin-list-items']);
      $categoryModel = new CategoryModel();
      $itemCategory = $categoryModel->listItems(null,['task' => 'news-list-items-in-selectbox']);
      $countByStatus = $this->model->countItems($this->params,['task' => 'count-items']);
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'items' => $items,
        'itemCategory' => $itemCategory,
        'countByStatus' => $countByStatus
      ]);
    }
    public function form(Request $request)
    { 
      $item = null;
      if(!empty($request->id)) {
        $params['id'] = $request->id;
        $item = $this->model->getItem($params,['task' => 'get-item']);
        
      }
      $categoryModel = new CategoryModel();
      $itemCategory = $categoryModel->listItems(null,['task' => 'news-list-items-in-selectbox']);
      return view($this->pathViewController.'form',[
        'item' => $item,
        'itemCategory' => $itemCategory
      ]);
    }
    public function delete(Request $request)
    {
      $params['id'] = $request->id;
      $this->model->deleteItem($params,['task' => 'delete-item']);
      return redirect()->route($this->controllerName)->with('success', 'Delete Success!');;
    }
    public function status(Request $request){
      $params['id'] = $request->id;
      $params['status'] = $request->status;
      $this->model->saveItems($params,['task' => 'change-status']);
      return redirect()->route($this->controllerName)->with('success', 'Status Updated!');;
    }
    public function type(Request $request){
      $params['id'] = $request->id;
      $params['type'] = $request->type;
      $this->model->saveItems($params,['task' => 'change-type']);
      return redirect()->route($this->controllerName)->with('success', 'Type Updated!');;
    }
}