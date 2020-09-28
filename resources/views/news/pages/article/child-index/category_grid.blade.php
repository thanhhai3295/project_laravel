<div class="world">
    <div class="row world_row">
        <div class="col-lg-11">
            <div class="row">
                @foreach ($item['related_articles'] as $item)
                <div class="col-lg-6">
                    <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                        @include('news.partials.article.image',['item' => $item])
                        @include('news.partials.article.content',['item' => $item,'lengthContent' => 200,'showCategory' => false])
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="home_button mx-auto text-center"><a href="the-loai/giao-duc-2.html">Xem
                    thêm</a></div>
            </div>
        </div>
    </div>
</div>