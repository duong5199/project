@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm thông tin quá trình công tác</h3>
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
            @foreach($employeeId as $id)
            <input type="hidden" name="Id" value="{{$id->employee_id}}">
            @endforeach
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phòng ban</label>
                        <select class="form-control select2" style="width: 100%;" name="Department">
                            @foreach($Department as $de)
                            <option value="{{$de->department_id}}">{{$de->department_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Chức vụ</label>
                        <select class="form-control select2" style="width: 100%;" name="Position">
                            @foreach($Position as $po)
                            <option value="{{$po->position_id}}">{{$po->position_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ngày nhậm chức</label>
                        <input type="date" class="form-control" name="StartDate">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" name="EndDate">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tên công ty</label>
                        <input type="text" class="form-control" placeholder="Tên công ty ..." name="CompanyName">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ ..." name="CompanyAddress">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control" placeholder="Ghi chú ..." name="Note">
                    </div>
                </div>
            </div>
            <div class="row" align="center">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection