@php
    use App\Helpers\Template as Template;
    use App\Helpers\URL;
@endphp
<!-- Latest Posts -->
<div class="sidebar_latest">
    <div class="sidebar_title">Bài viết gần đây</div>
    @foreach ($items as $item)
        @php
            $name = $item['name'];
            $categoryName = $item['category_name'];
            $linkCategory = URL::linkCategory($item['category_name'],$item['category_id']);
            $linkArticle  = URL::linkArticle($name,$item['id']);
            $thumb = asset('assmin/img/article/'.$item['thumb']);
            $created = Template::showDateTimeFrontEnd($item['created']);
        @endphp
        <div class="latest_posts">
            <!-- Latest Post -->
            <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                <div>
                    <div class="latest_post_image">
                        <img src="{{$thumb}}" alt="{{$name}}">
                    </div>
                </div>
                <div class="latest_post_content">
                    <div class="post_category_small cat_video"><a href="{{$linkCategory}}">{{$categoryName}}</a></div>
                    <div class="latest_post_title"><a href="{{$linkArticle}}">{{$name}}</a></div>
                    <div class="latest_post_date">{{$created}}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>