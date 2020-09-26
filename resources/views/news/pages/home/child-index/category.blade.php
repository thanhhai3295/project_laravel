@foreach ($itemsCategory as $item)
    @if ($item['display'] == 'grid')
        @include('news.pages.home.child-index.category_grid')
    @else
        @include('news.pages.home.child-index.category_list')
    @endif
@endforeach

