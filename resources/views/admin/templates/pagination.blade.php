<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-dark">{{$items->perPage()}} Items Per Page</button>
            <button class="btn btn-success">{{$items->total()}} items</button>
            <button class="btn btn-danger">{{$items->lastPage()}} Pages</button>
        </div>
        <div class="col-md-6">
            <nav aria-label="Page navigation example ">
                <div class="zvn-pagination">
                {{ $items->appends(request()->input())->links('pagination.pagination_backend') }}
                </div>
            </nav> 
        </div>
    </div>
</div>