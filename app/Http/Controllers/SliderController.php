<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class SliderController extends Controller
{
    private $pathViewController = 'admin.slider.';
    public function __construct()
    {
      view()->share('test','share data');
    }
    public function index()
    {
      return view($this->pathViewController.'index');
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