@extends('admin.main')
@section('content')
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Danh sách User</h3>
    </div>
    <div class="zvn-add-new pull-right">
        <a href="/form" class="btn btn-success"><i
                class="fa fa-plus-circle"></i> Thêm mới</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title' => 'Bộ lọc']);
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6"><a
                            href="?filter_status=all" type="button"
                            class="btn btn-primary">
                        All <span class="badge bg-white">4</span>
                    </a><a href="?filter_status=active"
                            type="button" class="btn btn-success">
                        Active <span class="badge bg-white">2</span>
                    </a><a href="?filter_status=inactive"
                            type="button" class="btn btn-success">
                        Inactive <span class="badge bg-white">2</span>
                    </a>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button"
                                        class="btn btn-default dropdown-toggle btn-active-field"
                                        data-toggle="dropdown" aria-expanded="false">
                                    Search by All <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="#"
                                            class="select-field" data-field="all">Search by All</a></li>
                                    <li><a href="#"
                                            class="select-field" data-field="id">Search by ID</a></li>
                                    <li><a href="#"
                                            class="select-field" data-field="username">Search by Username</a>
                                    </li>
                                    <li><a href="#"
                                            class="select-field" data-field="fullname">Search by Fullname</a>
                                    </li>
                                    <li><a href="#"
                                            class="select-field" data-field="email">Search by Email</a></li>
                                </ul>
                            </div>
                            <input type="text" class="form-control" name="search_value" value="">
                            <span class="input-group-btn">
                        <button id="btn-clear" type="button" class="btn btn-success"
                                style="margin-right: 0px">Xóa tìm kiếm</button>
                        <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                        </span>
                            <input type="hidden" name="search_field" value="all">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="select_filter" class="form-control"
                                data-field="level">
                            <option value="default" selected="selected">Select Level</option>
                            <option value="admin">Admin</option>
                            <option value="member">Member</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--box-lists-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title' => 'Danh Sách']);
            <div class="x_content">
                @include('admin.pages.slider.list')
            </div>
        </div>
    </div>
</div>
<!--end-box-lists-->
<!--box-pagination-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title' => 'Phân Trang']);
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6">
                        <p class="m-b-0">Số phần tử trên trang: <b>2</b> trên <span
                                class="label label-success label-pagination">3 trang</span></p>
                        <p class="m-b-0">Hiển thị<b> 1 </b> đến<b> 2</b> trên<b> 6</b> Phần tử</p>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination zvn-pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">«</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">»</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end-box-pagination-->
@endsection