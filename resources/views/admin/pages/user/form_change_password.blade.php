@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $inputHiddenID = Form::hidden('id', $item['id']);
  $inputHiddenTask = Form::hidden('task', 'change-password');
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $elements = [
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
      'type' => 'btn-submit',
      'element' => $inputHiddenID.$inputHiddenTask.Form::submit('Save',['class' => 'btn btn-success'])
    ]
  ];
@endphp

<div class="col-md-6 col-sm-12 col-xs-12">
  <div class="x_panel">
    @include('admin.templates.x_title',['title' => 'Form Change Password'])
    <div class="x_content">
    {!! Form::open([
          'method' => 'POST',
          'url' => route("$controllerName/change-password"),
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
