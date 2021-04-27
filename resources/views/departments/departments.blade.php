@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <!-- <div class="container-fluid" style="margin-bottom: 15px;">
        <a class="btn btn-primary" href="/departments/add" role="button">Thêm phòng ban</a>
    </div> -->
    <div class="row">
        <div class="card  card-primary col-md-4">
            <div class="card-header">
                <h2 class="card-title">Thêm mới phòng ban</h2>
            </div>
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form role="form" method="POST" action="" style="margin: 20px">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Mã phòng ban</label>
                            <input type="text" class="form-control" placeholder="Mã phòng ban ..."
                                name="departmentCode">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Tên phòng ban</label>
                            <input type="text" class="form-control" placeholder="Tên phòng ban ..."
                                name="departmentName">
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
                <h2 class="card-title">Danh sách phòng ban</h2>
                <div class="card-tools">
                    <div class="btn-group">
                        <div class="form-inline">
                            <div class="input-group input-group-sm" data-widget="sidebar-search">
                                <input class="form-control form-control-sidebar" type="search"
                                    placeholder="Tên phòng ban..." aria-label="Search">
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
                                    <th>Mã phòng ban</th>
                                    <th>Tên phòng ban</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            @foreach($departments as $key => $view)
                            <tbody>
                                <tr>
                                    <td>{{$key + 1 }}</td>
                                    <td>
                                        {{$view->department_code }}
                                    </td>
                                    <td>
                                        {{$view->department_name }}
                                    </td>
                                    <td>
                                        @if ($view->status === 0)
                                        <a href="/departments/edit/{{$view->department_id}}">
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