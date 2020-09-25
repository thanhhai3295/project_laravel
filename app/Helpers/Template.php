<?php 
  namespace App\Helpers;
  use Config;
  use Route;
  class Template {
    public static function showButtonFilter($controllerName,$countByStatus,$currentFilterStatus,$paramsSearch){
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
          if($paramsSearch['value'] != '') {
            $link .= "&search_field={$paramsSearch['field']}&search_value={$paramsSearch['value']}";
          }
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
    public static function showItemStatus($controllerName,$id,$statusValue) {
      $tmplStatus = Config::get('zvn.template.status');
      $statusValue = array_key_exists($statusValue,$tmplStatus) ? $statusValue : 'default';
      $currentStatus = $tmplStatus[$statusValue];
      $link = Route($controllerName.'/status',['status' => $statusValue, 'id' => $id]);
      $xhtml = '<a href="'.$link.'" type="button" class="btn btn-round '.$currentStatus['class'].'">'.$currentStatus['name'].'</a>';
      return $xhtml;
    }
    public static function showItemIsHome($controllerName,$id,$isHomeValue) {
      $tmplIsHome = Config::get('zvn.template.is_home');
      $isHomeValue = array_key_exists($isHomeValue,$tmplIsHome) ? $isHomeValue : '1';
      $currentisHome = $tmplIsHome[$isHomeValue];
      $link = Route($controllerName.'/isHome',['isHome' => $isHomeValue, 'id' => $id]);
      $xhtml = '<a href="'.$link.'" type="button" class="btn btn-round '.$currentisHome['class'].'">'.$currentisHome['name'].'</a>';
      return $xhtml;
    }
    public static function showItemDisplay($controllerName,$id,$displayValue) {
      $tmplDisplay = Config::get('zvn.template.display');
      $link = route($controllerName.'/display',['display' => 'value_new','id' => $id]);
      $xhtml = '<select name="select_change_attr" data-url="'.$link.'"  class="form-control">';
      foreach ($tmplDisplay as $key => $value) {
        $xhtmlSelected = ($key == $displayValue) ? 'selected="selected"' : '';
        $xhtml .= '<option '.$xhtmlSelected.' value="'.$key.'">'.$value['name'].'</option>';
      }
      $xhtml .= '</select>';
      return $xhtml;
    }
    public static function showItemThumb($controllerName,$thumbName,$thumbAlt){
      $xhtml = '<img src="'.asset("assmin/img/$controllerName/$thumbName").'" alt="'.$thumbAlt.'" class="zvn-thumb" id="blah">';
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
    public static function showMessageNotify(){
      if (request()->session()->has('success')) {
        $message = session('success');
        echo "<script>notify('$message')</script>";
        request()->session()->forget('success');
      }
    }
  }
?>