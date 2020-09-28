@extends('news.main',['title' => $itemsArticle['name']])
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb_article',['item' => $itemsArticle])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-9">
                        <div class="single_post"> 
                        @include('news.pages.article.child-index.article')
                        @include('news.pages.article.child-index.related',['item' => $itemsArticle])
                        </div>
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