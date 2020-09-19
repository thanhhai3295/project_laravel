<?php 
  return [
    'format' => [
      'long_time' => 'H:m:s d/m/Y',
      'short_time'=> 'd/m/Y'
    ],
    'template' => [
      'status' => [
        'all' => ['class' => 'btn-primary', 'name' =>'All'],
        'active' => ['class' => 'btn-success', 'name' =>'Active'],
        'inactive' => ['class' => 'btn-danger', 'name' =>'Inactive'],
        'default' => ['class' => 'btn-info', 'name' =>'undefined']
      ]
    ]
  ];
?>