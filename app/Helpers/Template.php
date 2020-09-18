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
  }
?>