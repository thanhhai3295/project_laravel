@php
    use App\Helpers\Template as Template; 
    use App\Helpers\Highlight as Highlight; 
@endphp

<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title">#</th>
        <th class="column-title">Username</th>
        <th class="column-title">Fullname</th>
        <th class="column-title">Email</th>
        <th class="column-title">Level</th>
        <th class="column-title">Avatar</th>
        <th class="column-title">Trạng thái</th>
        <th class="column-title">Tạo mới</th>
        <th class="column-title">Chỉnh sửa</th>
        <th class="column-title">Hành động</th>
      </tr>
    </thead>
      <tbody>          
        @if (count($items) > 0)
        @foreach ($items as $key => $value)
          @php
            $id              = $value['id'];
            $index           = $key + 1;
            $class           = ($index % 2 == 0 ) ? 'event' : 'odd';
            $username        = Highlight::show($value['username'],$params['search'],'username');
            $email           = Highlight::show($value['email'],$params['search'],'email');
            $fullname        = Highlight::show($value['fullname'],$params['search'],'fullname');
            $level           = Template::showItemSelect($controllerName,$id,$value['level'],'level');
            $avatar          = Template::showItemThumb($controllerName,$value['avatar'],$value['username']);
            $createdHistory  = Template::showItemHistory($value['created_by'],$value['created']);
            $modifiedHistory = Template::showItemHistory($value['modified_by'],$value['modified']);
            $status          = Template::showItemStatus($controllerName,$id,$value['status']);
            $listBtnAction   = Template::showButtonAction($controllerName,$id);
          @endphp 
          <tr class="{{ $class }} pointer">
            <td>{{ $index }}</td>
            <td width="20%">{{ $username }}</td>
            <td width="10%">{{ $fullname }}</td>
            <td width="10%">{{ $email }}</td>
            <td width="10%">{!! $level !!}</td>
            <td width="5%">{!! $avatar !!}</td>
            <td width="5%">{!! $status !!}</td>
            <td>{!! $createdHistory !!}</td>           
            <td>{!! $modifiedHistory !!}</td>
            <td class="last">{!! $listBtnAction !!}</td>
          </tr>
        @endforeach
        @else
          @include('admin.templates.list_empty',['colspan' => 6])
        @endif                              
            
      </tbody>
  </table>
</div>
