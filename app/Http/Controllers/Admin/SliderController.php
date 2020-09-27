<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest as MainRequest;
class SliderController extends Controller
{
    private $model;
    private $controllerName     = 'slider';
    private $pathViewController = 'admin.pages.slider.';
    private $params             = [];
    public function __construct()
    {
      $this->params['pagination']['totalItemsPerPage'] = 4;
      $this->model = new MainModel();
      view()->share('controllerName',$this->controllerName);
    }
    public function index(Request $request)
    { 
      $this->params['filter']['status'] = $request->input('filter_status','all');
      $this->params['search']['field'] = $request->input('search_field','');
      $this->params['search']['value'] = $request->input('search_value','');
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
      $item = null;
      if(!empty($request->id)) {
        $params['id'] = $request->id;
        $item = $this->model->getItem($params,['task' => 'get-item']);
      }
      return view($this->pathViewController.'form',[
        'item' => $item
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
    public function save(MainRequest $request) {
      if($request->method() == 'POST') {
        $params = $request->all();
        $task = 'add-item';
        $notify = 'Add Item Success!';
        if($params['id'] != NULL) {
          $task = 'edit-item';
          $notify = 'Edit Item Success!';
        }
        $this->model->saveItems($params,['task' => $task]);
        return redirect()->route($this->controllerName)->with('success',$notify);
      }
    }
}