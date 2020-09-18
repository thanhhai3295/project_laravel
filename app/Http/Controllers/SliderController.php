<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SliderModel as MainModel;
use Illuminate\Http\Request;
class SliderController extends Controller
{
    private $model;
    private $controllerName = 'slider';
    private $pathViewController = 'admin.pages.slider.';
    public function __construct()
    {
      $this->model = new MainModel();
      view()->share('controllerName',$this->controllerName);
    }
    public function index()
    {
      $items = $this->model->listItems(null,['task' => 'admin-list-items']);
      return view($this->pathViewController.'index',[
        'items' => $items
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