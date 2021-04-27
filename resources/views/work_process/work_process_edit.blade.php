@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cập nhật thông tin quá trình công tác</h3>
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
            @foreach($WPInfor as $temp)
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Mã nhân viên</label>
                        <input type="text" class="form-control" value="{{$temp->employee_code}}" name="id" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tên nhân viên</label>
                        <input type="text" class="form-control" value="{{$temp->fullname}}" disabled>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phòng ban</label>
                        <select class="form-control select2" style="width: 100%;" name="Department">
                            @foreach($Department as $de)
                            @if ($de->department_id === $temp->department_id)
                            <option value="{{$de->department_id}}" selected>{{$de->department_name}}</option>
                            @else
                            <option value="{{$de->department_id}}">{{$de->department_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Chức vụ</label>
                        <select class="form-control select2" style="width: 100%;" name="Position">
                            @foreach($Position as $po)
                            @if ($po->position_id === $temp->position_id)
                            <option value="{{$po->position_id}}" selected>{{$po->position_name}}</option>
                            @else
                            <option value="{{$po->position_id}}">{{$po->position_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ngày nhậm chức</label>
                        <input type="date" class="form-control" name="StartDate" value="{{$temp->start_date}}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" name="EndDate" value="{{$temp->end_date}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tên công ty</label>
                        <input type="text" class="form-control" value="{{$temp->company_name}}" name="CompanyName">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" value="{{$temp->company_address}}"
                            name="CompanyAddress">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control" value="{{$temp->note}}" name="Note">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Trạng thái &ensp; &ensp;</label>
                        <input class="" type="radio" id="hieuluc" value="0" name="status" checked>
                        <label class="form-check-label" for="hieuluc">Hiệu lực</label>&ensp; &ensp;
                        <input class="" type="radio" id="hethieuluc" value="1" name="status">
                        <label class="form-check-label" for="hethieuluc">Hết hiệu lực</label>
                    </div>
                </div>
            </div>
            <div class="row" align="center">
                <div class="col-sm-12">
                    <div class="form-group">
                        <a href="/employee/detail/{{ $temp->employee_id }}" class="btn btn-danger">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection