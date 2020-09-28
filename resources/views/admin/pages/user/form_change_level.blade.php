@php
  use App\Helpers\Template as Template; 
  use App\Helpers\Form as FormTemplate; 
  $inputHiddenID = Form::hidden('id', $item['id']);
  $inputHiddenTask = Form::hidden('task', 'change-level');
  $formInputAttr = config('zvn.template.form_input');
  $formLabelAttr = config('zvn.template.form_label');
  $levelValue = [
    'default'  => 'Select Level',
    'admin'   => config('zvn.template.level.admin.name'),
    'member' => config('zvn.template.level.member.name')
  ];
  $elements = [
    [
      'label' => Form::label('level', 'Level',$formLabelAttr),
      'element' => Form::select('level', $levelValue, $item['level'],$formInputAttr),
      'error' => 'level'
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
          'url' => route("$controllerName/change-level"),
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
