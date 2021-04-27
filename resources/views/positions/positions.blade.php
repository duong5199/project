@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <!-- <div class="container-fluid" style="margin-bottom: 15px;">
        <a class="btn btn-primary" href="/departments/add" role="button">Thêm phòng ban</a>
    </div> -->
    <div class="row">
        <div class="card  card-primary col-md-4">
            <div class="card-header">
                <h2 class="card-title">Thêm mới chức vụ</h2>
            </div>

            <form role="form" method="POST" action="" style="margin: 20px">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Mã chức vụ</label>
                            <input type="text" class="form-control" placeholder="Mã chức vụ ..."
                                name="positionCode">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Tên chức vụ</label>
                            <input type="text" class="form-control" placeholder="Tên chức vụ ..."
                                name="positionName">
                        </div>
                    </div>
                </div>
                <div class="row" align="center">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <a href="#" class="btn btn-danger">Hủy</a>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="card col-md-8">
            <div class="card-header">
                <h2 class="card-title">Danh sách chức vụ</h2>
                <div class="card-tools">
                    <div class="btn-group">
                        <div class="form-inline">
                            <div class="input-group input-group-sm" data-widget="sidebar-search">
                                <input class="form-control form-control-sidebar" type="search"
                                    placeholder="Tên chức vụ..." aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20px">#</th>
                                    <th>Mã chức vụ</th>
                                    <th>Tên chức vụ</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            @foreach($positions as $key => $view)
                            <tbody>
                                <tr>
                                    <td>{{$key + 1 }}</td>
                                    <td>
                                        {{$view->position_code }}
                                    </td>
                                    <td>
                                        {{$view->position_name }}
                                    </td>
                                    <td>
                                        @if ($view->status === 0)
                                        <a href="/positions/edit/{{$view->position_id}}">
                                            <i class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                title="Cập nhật"></i></a>
                                        @else
                                        <i class="nav-icon fas fa-edit" disabled></i>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Hiển thị từ
                                1
                                đến 10 của {{$numberOfRecords}} kết quả
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <nav>
                                <ul class="pagination float-right">
                                    @for($i = 1; $i <= $numberOfPage; $i++) <li
                                        class="page-item {{ ($page == $i) ? 'active' : '' }}">
                                        <a class="page-link" href="departments?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                        @endfor
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection