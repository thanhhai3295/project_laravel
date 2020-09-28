@extends('admin.main')
@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $inputHiddenID = Form::hidden('id', $item['id']);
  $inputHiddenTask = Form::hidden('task', 'add');
  $inputHiddenAvatar = Form::hidden('avatar_current', $item['avatar']);
  $statusValue = [
    'default'  => config('zvn.template.status.default.name'),
    'active'   => config('zvn.template.status.active.name'),
    'inactive' => config('zvn.template.status.inactive.name')
  ];
  $levelValue = [
    'default'  => 'Select Level',
    'admin'   => config('zvn.template.level.admin.name'),
    'member' => config('zvn.template.level.member.name')
  ];
  $elements = [
    [
      'label' => Form::label('username', 'Username',$formLabelAttr),
      'element' => Form::text('username', $item['username'],$formInputAttr),
      'error' => 'username'
    ],
    [
      'label' => Form::label('fullname', 'Fullname',$formLabelAttr),
      'element' => Form::text('fullname', $item['fullname'],$formInputAttr),
      'error' => 'fullname'
    ],
    [
      'label' => Form::label('email', 'Email',$formLabelAttr),
      'element' => Form::text('email', $item['email'],$formInputAttr),
      'error' => 'email'
    ],
    [
      'label' => Form::label('password', 'Password',$formLabelAttr),
      'element' => Form::text('password', $item['password'],$formInputAttr),
      'error' => 'password'
    ],
    [
      'label' => Form::label('password_confirmation', 'Password Confirmation',$formLabelAttr),
      'element' => Form::text('password_confirmation', $item['password_confirmation'],$formInputAttr),
      'error' => 'password_confirmation'
    ],
    [
      'label' => Form::label('status', 'Status',$formLabelAttr),
      'element' => Form::select('status', $statusValue, $item['status'],$formInputAttr),
      'error' => 'status'
    ],
    [
      'label' => Form::label('level', 'Level',$formLabelAttr),
      'element' => Form::select('level', $levelValue, $item['level'],$formInputAttr),
      'error' => 'level'
    ],
    [
      'label' => Form::label('avatar', 'Avatar',$formLabelAttr),
      'element' => Form::file('avatar',$formInputAttr),
      'avatar' => !empty($item['id']) ? Template::showItemThumb($controllerName,$item['avatar'],$item['username']) : null,
      'type' => 'avatar',
      'error' => 'avatar'
    ],
    [
      'type' => 'btn-submit',
      'element' => $inputHiddenID.$inputHiddenAvatar.$inputHiddenTask.Form::submit('Save',['class' => 'btn btn-success'])
    ]
  ];
@endphp
@section('content')

@include('admin.templates.page_header',['pageIndex' => false])

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      @include('admin.templates.x_title',['title' => 'Form Add'])
      <div class="x_content">
      {!! Form::open([
            'method' => 'POST',
            'url' => route("$controllerName/save"),
            'accept-charset' => 'UTF-8',
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal form-label-left',
            'id' => 'main-form'
      ]) !!}
      {!! FormTemplate::show($elements,$errors) !!}
      {!! Form::close() !!}
    </div>
      
      
    </div>
  </div> 
</div>

@endsection