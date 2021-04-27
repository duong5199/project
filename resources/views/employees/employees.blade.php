@extends('layouts.default')
@section('title', '/ Danh sách nhân viên')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon">
                    <img src="dist/img/candidate.png">
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Đang làm việc</span>
                    <span class="info-box-number">{{$active}}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon">
                    <img src="dist/img/candidates.png">
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Đã nghỉ việc</span>
                    <span class="info-box-number">{{$inactive}}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon">
                    <img src="dist/img/N.png">
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Nhân viên nam</span>
                    <span class="info-box-number">{{$male}}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon">
                    <img src="dist/img/Nu.png">
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Nhân viên nữ</span>
                    <span class="info-box-number">{{$female}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-bottom: 15px;">
    <a class="btn btn-primary" href="/employee/add" role="button">Thêm nhân viên</a>
</div>
<div class="card">
    <?php
    @$G_search = $_POST['search'];
    ?>
    <div class="card-header">
        <h5 class="card-title">Danh sách nhân viên</h5>
        <div class="card-tools">
            <div class="btn-group">
                <div class="form-inline">
                    <div class="input-group input-group-sm" data-widget="sidebar-search">
                        <form method="POST" id="header-search">
                            <input type="text" name="search" value="{{$G_search}}" class="form-control m-input"
                                placeholder="Tên nhân viên..." />
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-fw"></i></button>
                        </form>
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
                        <tr align="center">
                            <th style="width: 20px">#</th>
                            <th>Họ tên</th>
                            <th>Công ty</th>
                            <th>Liên hệ</th>
                            <th>Quyền hạn</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    @if($errors->any())

                    <div class="">
                        @foreach($errors->all() as $error)
                        <span style="color:red">{{ $error }}</span>
                        @endforeach
                    </div>
                    @endif
                    <?php
                        if (!empty($_POST['search']))  {
                    ?>
                    @foreach($value_search as $keyS => $employeeS)
                    <tbody>

                        <tr>
                            <td>{{$keyS + 1 }}</td>
                            <td>
                                <div class="row">
                                    <div class="user-block col-md-3">
                                        @if ($employeeS->img !== '')
                                        <img class="img-circle img-bordered-sm" style="width: 55px; height: 60px"
                                            src="{{ asset('/dist/img/Anh_The/'.$employeeS->img)}}" alt="user image">
                                        @else
                                        <img class="img-circle img-bordered-sm" style="width: 55px; height: 60px"
                                            src="{{ asset('/dist/img/Anh_The/user.png')}}" alt="user image">
                                        @endif

                                    </div>
                                    <div class="col-md-9">
                                        <a href="#" class="btn-tool text-bold">{{ $employeeS->employee_code }}</a> <br>
                                        <span class="username">
                                            <a
                                                href="/employee/detail/{{ $employeeS->employee_id }}">{{ $employeeS->fullname }}</a>
                                        </span><br>
                                        <span class="description"><a href="#">Download Profile <i
                                                    class="fas fa-download"></i></a></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="username"><i class="fas fa-building"></i>
                                    {{ $employeeS->company_name }}</span>
                                <i class="text-sm">
                                    <br>Địa chỉ: {{ $employeeS->company_address }}
                                    <br>Phòng ban: {{ $employeeS->department_name }}
                                    <br>Chức vụ: {{ $employeeS->position_name }}
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-user" data-toggle="tooltip" data-placement="top" title="Họ tên"></i>
                                {{ $employeeS->fullname }}
                                <br>
                                <i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Email"></i>
                                {{ $employeeS->email }}
                                <br>
                                <i class="fa fa-phone" data-toggle="tooltip" data-placement="top"
                                    title="Số điện thoại"></i> {{ $employeeS->phone_number }}
                            </td>
                            <td>
                                <span class="username">
                                    @if ($employeeS->role === 'admin')
                                    Quản trị
                                    @else
                                    Nhân viên
                                    @endif
                                </span>
                                <br>
                                @if ($employeeS->is_active === 'active')
                                <span class="badge badge-success">Hoạt động</span>
                                @elseif ($employeeS->is_active === 'inactive')
                                <span class="badge badge-danger">Khóa</span>
                                @else
                                <span class="badge badge-secondary">Chưa có tài khoản</span>
                                @endif
                            </td>
                            <td align="center">
                                @if ($employeeS->is_active === 'active' || $employeeS->is_active === 'inactive')
                                <i class="fa fa-user-plus disabled" style="color: grey"></i>
                                @else
                                <a href="/User/add_new_acount/{{ $employeeS->employee_id }}">
                                    <i class="fa fa-user-plus" data-toggle="tooltip" title="Thêm tài khoản"
                                        data-placement="left"></i>
                                </a>
                                @endif
                                &ensp;
                                <a href="/employee/delete/{{ $employeeS->employee_id }}"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    <?php
                        }
                    ?>
                    <?php
                        if (empty($_POST['search'])) {
                    ?>
                    @foreach($employees as $key => $employee)
                    <tbody>
                        <tr>
                            <td>{{$key + 1 }}</td>
                            <td>
                                <div class="row">
                                    <div class="user-block col-md-3">
                                        @if ($employee->img !== '')
                                        <img class="img-circle img-bordered-sm" style="width: 55px; height: 60px"
                                            src="{{ asset('/dist/img/Anh_The/'.$employee->img)}}" alt="user image">
                                        @else
                                        <img class="img-circle img-bordered-sm" style="width: 55px; height: 60px"
                                            src="{{ asset('/dist/img/Anh_The/user.png')}}" alt="user image">
                                        @endif

                                    </div>
                                    <div class="col-md-9">
                                        <a href="#" class="btn-tool text-bold">{{ $employee->employee_code }}</a> <br>
                                        <span class="username">
                                            <a
                                                href="/employee/detail/{{ $employee->employee_id }}">{{ $employee->fullname }}</a>
                                        </span><br>
                                        <span class="description"><a href="#">Download Profile <i
                                                    class="fas fa-download"></i></a></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="username"><i class="fas fa-building"></i>
                                    {{ $employee->company_name }}</span>
                                <i class="text-sm">
                                    <br>Địa chỉ: {{ $employee->company_address }}
                                    <br>Phòng ban: {{ $employee->department_name }}
                                    <br>Chức vụ: {{ $employee->position_name }}
                                </i>
                            </td>
                            <td>
                                <i class="fa fa-user" data-toggle="tooltip" data-placement="top" title="Họ tên"></i>
                                {{ $employee->fullname }}
                                <br>
                                <i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Email"></i>
                                {{ $employee->email }}
                                <br>
                                <i class="fa fa-phone" data-toggle="tooltip" data-placement="top"
                                    title="Số điện thoại"></i> {{ $employee->phone_number }}
                            </td>
                            <td>
                                <span class="username">
                                    @if ($employee->role === 'admin')
                                    Quản trị
                                    @else
                                    Nhân viên
                                    @endif
                                </span>
                                <br>
                                @if ($employee->is_active === 'active')
                                <span class="badge badge-success">Hoạt động</span>
                                @elseif ($employee->is_active === 'inactive')
                                <span class="badge badge-danger">Khóa</span>
                                @else
                                <span class="badge badge-secondary">Chưa có tài khoản</span>
                                @endif
                            </td>
                            <td align="center">
                                @if ($employee->is_active === 'active' || $employee->is_active === 'inactive')
                                <i class="fa fa-user-plus disabled" style="color: grey"></i>
                                @else
                                <a href="/User/add_new_acount/{{ $employee->employee_id }}">
                                    <i class="fa fa-user-plus" data-toggle="tooltip" title="Thêm tài khoản"
                                        data-placement="left"></i>
                                </a>
                                @endif
                                &ensp;
                                <a href="/employee/delete/{{ $employee->employee_id }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    <?php
                        }
                    ?>
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
                        của {{$numberOfRecords}} kết quả
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <nav>
                        <ul class="pagination float-right">
                            @for($i = 1; $i <= $numberOfPage; $i++) <li
                                class="page-item {{ ($page == $i) ? 'active' : '' }}">
                                <a class="page-link" href="Employees?page={{ $i }}">{{ $i }}</a>
                                </li>
                                @endfor
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection