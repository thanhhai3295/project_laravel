@extends('admin.main')
@php
    use App\Helpers\Template as Template; 
    $xhtmlButtonFilter = Template::showButtonFilter($controllerName,$countByStatus,$params['filter']['status'],$params['search']);
    $xhtmlAreaSearch   = Template::showAreaSearch($controllerName,$params['search']);
@endphp
@section('content')

@include('admin.templates.page_header',['pageIndex' => true])
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title' => 'Bộ lọc'])
            <div class="x_content">
                <div class="row">
                    <div class="col-md-7"> {!!$xhtmlButtonFilter!!} </div>                   
                    <div class="col-md-5"> {!!$xhtmlAreaSearch!!} </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--box-lists-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title' => 'Danh Sách'])
            <div class="x_content">
                @include('admin.pages.slider.list')
            </div>
        </div>
    </div>
</div>
<!--end-box-lists-->
@if (count($items) > 0)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title',['title' => 'Phân Trang'])
                @include('admin.templates.pagination',['title' => 'Phân Trang','pagination' => $items])
            </div>
        </div>
    </div>  
@endif
@endsection