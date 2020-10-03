<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest as MainRequest;
class UserController extends AdminController
{

    public function __construct()
    {
      $this->pathViewController = 'admin.pages.user.';
      $this->controllerName     = 'user';
      parent::__construct();
      $this->model = new MainModel();
    }
    public function change_password(MainRequest $request){
      $params['id'] = $request->id;
      $params['password'] = $request->password;
      $this->model->saveItems($params,['task' => 'change-password']);
      return redirect()->route($this->controllerName)->with('success', 'Password Updated!');;
    }
    public function level(MainRequest $request){
      $params['id'] = $request->id;
      $params['level'] = $request->level;
      $this->model->saveItems($params,['task' => 'change-level']);
      return redirect()->route($this->controllerName)->with('success', 'Level Updated!');;
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