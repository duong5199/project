@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card  card-primary col-md-4">
            <div class="card-header">
                <h2 class="card-title">Thêm mới loại hợp đồng</h2>
            </div>
            @if(\Session::has('message'))
                <div class="alert alert-success p-2 m-4">
                    {{ \Session::get('message') }}
                </div>
            @endif
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
                            <label>Mã loại</label>
                            <input type="text" class="form-control" placeholder="Mã loại hợp đồng ..."
                                name="conTypeCode">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Tên loại</label>
                            <input type="text" class="form-control" placeholder="Tên loại hợp đồng ..."
                                name="conTypeName">
                        </div>
                    </div>
                </div>
                <div class="row" align="center">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <a href="/contractType" class="btn btn-danger">Hủy</a>
                            <button type="submit" name='AddConType' class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="card col-md-8">
            <div class="card-header">
                <h2 class="card-title">Danh sách loại hợp đồng</h2>
                
                <div class="card-tools">
                    <?php
                    @$G_search = $_POST['search'];
                    ?>
                    <div class="btn-group">
                        <div class="form-inline">
                            <div class="input-group input-group-sm" data-widget="sidebar-search">
                            <form method="POST">
                                <input  type="text" name="search" value="{{$G_search}}" class="form-control form-control-sidebar"
                                    placeholder="Tên loại hợp đông..." aria-label="Search"/>
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary" name="btnsearch"><i class="fas fa-search fa-fw"></i></button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            @if($errorsSearch->any())
                <div class="">
                        @foreach($errorsSearch->all() as $errorSearch)
                        <span style="color:red">{{ $errorSearch }}</span>
                        @endforeach
                </div>
            @endif
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20px">#</th>
                                    <th>Mã loại</th>
                                    <th>Tên loại</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <?php
                            if (!empty($_POST['search']))  {
                            ?>
                            @foreach($valueSearch as $keyS => $viewS)
                            <tbody>
                                <tr>
                                    <td>{{$keyS + 1 }}</td>
                                    <td>
                                        {{$viewS->contract_type_code }}
                                    </td>
                                    <td>
                                        {{$viewS->contract_type_name }}
                                    </td>
                                    <td>
                                        @if ($viewS->status === 0)
                                        <a href="/contractType/edit/{{$viewS->contract_type_id}}">
                                            <i class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                title="Cập nhật"></i></a>
                                        @else
                                        <i class="nav-icon fas fa-edit" disabled></i>
                                        @endif
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
                            @foreach($contractType as $key => $view)
                            <tbody>
                                <tr>
                                    <td>{{$key + 1 }}</td>
                                    <td>
                                        {{$view->contract_type_code }}
                                    </td>
                                    <td>
                                        {{$view->contract_type_name }}
                                    </td>
                                    <td>
                                        @if ($view->status === 0)
                                        <a href="/contractType/edit/{{$view->contract_type_id}}">
                                            <i class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                title="Cập nhật"></i></a>
                                        @else
                                        <i class="nav-icon fas fa-edit" disabled></i>
                                        @endif
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

    </div>
</div>
@endsection