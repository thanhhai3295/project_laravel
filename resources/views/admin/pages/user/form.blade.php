@extends('admin.main')
@section('content')

@if ($item['id'])
  @include('admin.templates.page_header',['pageIndex' => false])
  <div class="row">
    @include('admin.pages.user.form_edit_info')
    @include('admin.pages.user.form_change_password')
    @include('admin.pages.user.form_change_level')
  </div>  
@else
  @include('admin.pages.user.form_add')
@endif
@endsection


