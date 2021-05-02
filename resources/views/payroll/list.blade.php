@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tài khoản nhân viên</h5>
            <div class="card-tools">
                <div class="btn-group">
                    <div class="form-inline">
                        <div class="input-group input-group-sm" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Tên nhân viên..."
                                   aria-label="Search">
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
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Tên đăng nhập</th>
                            <th>Mật khẩu</th>
                            <th>Quyền</th>
                            <th>Loại</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Hiển thị từ 1 đến
                            <select name="example1_length" aria-controls="example1"
                                    class="custom-select custom-select-sm form-control form-control-sm"
                                    style="width: 60px; font-size: 15px; padding-top: 2px">
                                <option value="10">10</option>
                                <option value="25">20</option>
                                <option value="50">30</option>
                                <option value="100">50</option>
                            </select>
                            của kết quả
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <nav>
                            <ul class="pagination float-right">
{{--                                @for($i = 1; $i <= $numberOfPage; $i++) <li--}}
{{--                                    class="page-item {{ ($page == $i) ? 'active' : '' }}">--}}
{{--                                    <a class="page-link" href="User?page={{ $i }}">{{ $i }}</a>--}}
{{--                                </li>--}}
{{--                                @endfor--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <a href="/User/add_new_acount/1">
                  <i class="fa fa-user-plus" data-toggle="tooltip" title="Thêm tài khoản" data-placement="left"></i>
          </a>
          <a href="/User/edit/1">
                  <i class="fa fa-user-plus" data-toggle="tooltip" title="Cập nhật tài khoản" data-placement="left"></i>
          </a> -->
@endsection
