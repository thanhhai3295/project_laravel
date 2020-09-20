<?php 
  return [
    'format' => [
      'long_time' => 'H:m:s d/m/Y',
      'short_time'=> 'd/m/Y'
    ],
    'template' => [
      'status' => [
        'all'       => ['class' => 'btn-primary', 'name' =>'All'],
        'active'    => ['class' => 'btn-success', 'name' =>'Active'],
        'inactive'  => ['class' => 'btn-danger',  'name' =>'Inactive'],
        'default'   => ['class' => 'btn-info',    'name' =>'undefined']
      ],
      'search' => [
        'all'         => ['name' =>'Search By All'],
        'id'          => ['name' =>'Search By ID'],
        'name'        => ['name' =>'Search By Name'],
        'description' => ['name' =>'Search By Description'],
        'username'    => ['name' =>'Search By Username'],
        'fullname'    => ['name' =>'Search By Fullname'],
        'email'       => ['name' =>'Search By Email'],
        'link'        => ['name' =>'Search By link'],
        'content'     => ['name' =>'Search By Content'],
      ],
      'button' => [
        'edit'  => [
          'class' => 'btn-success','title' => 'Edit','icon' => 'fa-pencil','route-name' => '/form'
        ],
        'delete'=> [
          'class' => 'btn-danger','title' => 'Delete','icon' => 'fa-trash','route-name' => '/delete'
        ],
        'info'  => [
          'class' => 'btn-danger','title' => 'Delete','icon' => 'fa-trash','route-name' => '/delete'
        ]
      ]
    ],
    'config' => [
      'search' => [
        'default' => ['all','id','fullname'],
        'slider'  => ['all','id','name','description','link']
      ],
      'button' => [
        'default' => ['edit','delete'],
        'slider'  => ['edit','delete',]
      ]
    ]
  ];
?>