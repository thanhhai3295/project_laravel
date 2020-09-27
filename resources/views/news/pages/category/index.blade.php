@extends('news.main',['title' => request()->category_name])
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb')
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-9">
                        @include('news.pages.category.child-index.category',['item' => $itemsCategory])
                    </div>
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        <div class="sidebar">
                        @include('news.block.lastest_post',['items' => $itemsLastest])
                        @include('news.block.advertisement')
                        @include('news.block.most_view')
                        @include('news.block.tags')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection