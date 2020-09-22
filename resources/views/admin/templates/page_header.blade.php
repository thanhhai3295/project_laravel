@php
    $pageTitle = 'Quản Lý '.ucfirst($controllerName);
    $pageButton = ' <a href="'.route($controllerName).'" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay Về</a>';
    if($pageIndex) {
      $pageButton = ' <a href="'.route($controllerName.'/form').'" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm Mới</a>';
    }
    
@endphp
<div class="page-header zvn-page-header clearfix">
  <div class="zvn-page-header-title">
  <h3>{{$pageTitle}}</h3>
  </div>
  <div class="zvn-add-new pull-right">
  {!! $pageButton !!}
  </div>
</div>