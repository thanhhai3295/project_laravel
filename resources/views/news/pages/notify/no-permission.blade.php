@extends('news.main',['title' => 'No Permission'])
@section('content')

   
    <div class="content_container">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <h3>Bạn không có quyền truy cập vào chức năng này!! </h3>
                       
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                   
                        @include ('news.block.lastest_post', ['items' => $itemsLatest])

                        <!-- Advertisement -->
                        @include ('news.block.advertisement', ['itemsAdvertisement' => []])

                        <!-- MostViewed -->
                        @include ('news.block.most_view', ['itemsMostViewed' => []])

                        <!-- Tags -->
                        @include ('news.block.tags', ['itemsTags' => []])
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection