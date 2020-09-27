@if ($item['display'] == 'grid')
    @include('news.pages.category.child-index.category_grid')
@else
    @include('news.pages.category.child-index.category_list')
@endif


