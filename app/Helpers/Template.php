<?php 
  namespace App\Helpers;
  use Config;
  use Route;
  class Template {
    public static function showButtonFilter($controllerName,$countByStatus,$currentFilterStatus){
      $xhtml = null;
      $tmplStatus = Config::get('zvn.template.status');
      if(count($countByStatus) > 0) {
        array_unshift($countByStatus,[
          'status' => 'all',
          'count'  => array_sum(array_column($countByStatus,'count'))
        ]);
        foreach ($countByStatus as $key => $value) {
          $statusValue = $value['status'];
          $statusValue = array_key_exists($statusValue,$tmplStatus) ? $statusValue : 'default';
          $currentStatus = $tmplStatus[$statusValue];
          $link = Route($controllerName)."?filter_status=$statusValue";
          $class = ($currentFilterStatus == $statusValue) ? 'btn-danger' : 'btn-info';
          $xhtml .= '<a href="'.$link.'" type="button" class="btn '.$class.'"> 
                      '.$currentStatus['name'].' <span class="badge bg-white">'.$value['count'].'</span>
                    </a>';
        }
      }
      return $xhtml;      
    }
    public static function showAreaSearch($controllerName,$paramsSearch){
      $xhtml = null;
      $tmplField = Config::get('zvn.template.search');
      $fieldInController = Config::get('zvn.config.search');
      $controllerName = array_key_exists($controllerName,$fieldInController) ? $controllerName : 'default';
      $xhtmlField = null;
      foreach ($fieldInController[$controllerName] as $value) {
        $xhtmlField .= '<li>
                        <a href="#" class="select-field" data-field="'.$value.'">'.$tmplField[$value]['name'].'</a>
                      </li>';
      }
      $searchField = in_array($paramsSearch['field'],$fieldInController[$controllerName]) ? $paramsSearch['field'] : 'all';

      $xhtml = '<div class="input-group">
                  <div class="input-group-btn">
                      <button type="button"
                              class="btn btn-default dropdown-toggle btn-active-field"
                              data-toggle="dropdown" aria-expanded="false">
                          '.$tmplField[$searchField]['name'].' <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
                          '.$xhtmlField.'
                      </ul>
                  </div>
                  <input type="text" class="form-control" name="search_value" value="'.$paramsSearch['value'].'">
                  <span class="input-group-btn">
              <button id="btn-clear" type="button" class="btn btn-success"
                      style="margin-right: 5px">Xóa tìm kiếm</button>
              <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
              </span>
                  <input type="hidden" name="search_field" value="'.$searchField.'">
              </div>';
      return $xhtml;      
    }
    public static function showItemHistory($by, $time){
      $xhtml = '<p><i class="fa fa-user"></i> '.$by.'</p>
              <p><i class="fa fa-clock-o"></i>  '.date(Config::get('zvn.format.short_time'),strtotime($time)).'</p>';
      return $xhtml;      
    }
    public static function showItemStatus($controllerName,$id,$status) {
      $tmplStatus = Config::get('zvn.template.status');
      $statusValue = $status;
      $statusValue = array_key_exists($statusValue,$tmplStatus) ? $statusValue : 'default';
      $currentStatus = $tmplStatus[$statusValue];
      $link = Route($controllerName.'/status',['status' => $status, 'id' => $id]);
      $xhtml = '<a href="'.$link.'" type="button" class="btn btn-round '.$currentStatus['class'].'">'.$currentStatus['name'].'</a>';
      return $xhtml;
    }
    public static function showItemThumb($controllerName,$thumbName,$thumbAlt){
      $xhtml = '<img src="'.asset("assmin/img/$controllerName/$thumbName").'" alt="'.$thumbAlt.'" class="zvn-thumb">';
      return $xhtml;
    }
    public static function showButtonAction($controllerName,$id) {
      $tmplButton = Config::get('zvn.template.button');
      $buttonInArea = Config::get('zvn.config.button');

      $controllerName = array_key_exists($controllerName,$buttonInArea) ? $controllerName : 'default';
      $listButtons    = $buttonInArea[$controllerName];
      $xhtml = '<div class="zvn-box-btn-filter">';
      foreach ($listButtons as $key => $value) {
        $currentButton = $tmplButton[$value];
        $link = Route($controllerName.$currentButton['route-name'],['id' => $id]);
        $xhtml .= '<a href="'.$link.'" type="button" class="btn btn-icon '.$currentButton['class'].'" data-toggle="tooltip" data-placement="top" data-original-title="'.$currentButton['title'].'"><i class="fa '.$currentButton['icon'].'"></i>
                  </a>';
      }
      $xhtml .= '</div>';
      return $xhtml;
    }
  }
?>