<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SliderModel as MainModel;
use Illuminate\Http\Request;
class SliderController extends Controller
{
    private $model;
    private $controllerName     = 'slider';
    private $pathViewController = 'admin.pages.slider.';
    private $params             = [];
    public function __construct()
    {
      $this->params['pagination']['totalItemsPerPage'] = 2;
      $this->model = new MainModel();
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $this->params['filter']['status'] = $request->input('filter_status','all');
      $this->params['search']['field'] = $request->input('search_field','');
      $this->params['search']['value'] = $request->input('search_value','all');
      $items = $this->model->listItems($this->params,['task' => 'admin-list-items']);
      $countByStatus = $this->model->countItems($this->params,['task' => 'count-items']);
      return view($this->pathViewController.'index',[
        'params' => $this->params,
        'items' => $items,
        'countByStatus' => $countByStatus
      ]);
    }
    public function form(Request $request)
    { 
      return view($this->pathViewController.'form',[
        'id' => $request->id
      ]);
    }
    public function delete($id)
    {
      return view($this->pathViewController.'index');
    }
}