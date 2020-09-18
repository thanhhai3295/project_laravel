<?php 
  namespace App\Helpers;
  use Config;
  use Route;
  class Template {
    public static function showItemHistory($by, $time){
      $xhtml = '<p><i class="fa fa-user"></i> '.$by.'</p>
              <p><i class="fa fa-clock-o"></i>  '.date(Config::get('zvn.format.short_time'),strtotime($time)).'</p>';
      return $xhtml;      
    }
    public static function showItemStatus($controllerName,$id,$status) {
      $tmplStatus = [
        'active' => ['class' => 'btn-success', 'name' =>'Active'],
        'inactive' => ['class' => 'btn-danger', 'name' =>'Inactive']
      ];
      $currentStatus = $tmplStatus[$status];
      $link = Route($controllerName.'/status',['status' => $status, 'id' => $id]);
      $xhtml = '<a href="'.$link.'" type="button" class="btn btn-round '.$currentStatus['class'].'">'.$currentStatus['name'].'</a>';
      return $xhtml;
    }
    public static function showItemThumb($controllerName,$thumbName,$thumbAlt){
      $xhtml = '<img src="'.asset("assmin/img/$controllerName/$thumbName").'" alt="'.$thumbAlt.'" class="zvn-thumb">';
      return $xhtml;
    }
    public static function showButtonAction($controllerName,$id) {
      $tmplButton = [
        'edit'  => [
          'class' => 'btn-success','title' => 'Edit','icon' => 'fa-pencil','route-name' => $controllerName.'/form'
        ],
        'delete'=> [
          'class' => 'btn-danger','title' => 'Delete','icon' => 'fa-trash','route-name' => $controllerName.'/delete'
        ],
        'info'  => [
          'class' => 'btn-danger','title' => 'Delete','icon' => 'fa-trash','route-name' => $controllerName.'/delete'
        ]
      ];

      $buttonInArea = [
        'default' => ['edit','delete'],
        'slider'  => ['edit','delete']
      ];

      $controllerName = array_key_exists($controllerName,$buttonInArea) ? $controllerName : 'default';
      $listButtons    = $buttonInArea[$controllerName];
      $xhtml = '<div class="zvn-box-btn-filter">';
      foreach ($listButtons as $key => $value) {
        $currentButton = $tmplButton[$value];
        $link = Route($currentButton['route-name'],['id' => $id]);
        $xhtml .= '<a href="'.$link.'" type="button" class="btn btn-icon '.$currentButton['class'].'" data-toggle="tooltip" data-placement="top" data-original-title="'.$currentButton['title'].'"><i class="fa '.$currentButton['icon'].'"></i>
                  </a>';
      }
      $xhtml .= '</div>';
      return $xhtml;
    }
  }
?>