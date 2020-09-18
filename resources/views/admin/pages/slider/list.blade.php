@php
    use App\Helpers\Template as Template; 
@endphp
<div class="table-responsive">
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title">#</th>
        <th class="column-title">Slider Info</th>
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
            $name            = $value['name'];
            $description     = $value['description'];
            $link            = $value['link'];
            $thumb           = $value['thumb'];
            $createdHistory  = Template::showItemHistory($value['created_by'],$value['created']);
            $modifiedHistory = Template::showItemHistory($value['modified_by'],$value['modified']);
            $status          = Template::showItemStatus($controllerName,$id,$value['status']);
          @endphp 
          <tr class="{{ $class }} pointer">
            <td>{{ $index }}</td>
            <td width="40%">
              <p><strong>Name:</strong> {{ $name }}</p>
              <p><strong>Description:</strong> {{ $description }}</p>
              <p><strong>Link:</strong> {{ $link }}</p>
              <p><img src="{{ $thumb }}" alt="{{ $name }}" class="zvn-thumb"></p>
            </td>
            <td>
              {!! $status !!}
            </td>
            <td>{!! $createdHistory !!}</td>           
            <td>{!! $modifiedHistory !!}</td>
            <td class="last">
              <div class="zvn-box-btn-filter">
                <a href="http://proj_news.xyz/admin123/slider/form/3" type="button" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i>
                </a>
                <a href="http://proj_news.xyz/admin123/slider/delete/3" type="button" class="btn btn-icon btn-danger btn-delete" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><i class="fa fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
        @else
          @include('admin.templates.list_empty',['colspan' => 6])
        @endif                              
            
      </tbody>
  </table>
</div>
