@extends('news.main',['title' => 'Trang Chủ'])
@section('content')
  @include('news.block.slider')

<!-- START CONTENT -->
<!-- Content Container -->
  <div class="content_container">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main_content">
                    @include('news.block.feature')
                    <!-- Category -->
                    @include('news.pages.home.child-index.category')
                    
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

<!-- END CONTENT -->
@endsection