@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cập nhật quá trình lương</h3>
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
            @foreach($SPInfor as $temp)
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
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Số quyết định</label>
                        <input type="text" class="form-control" value="{{$temp->decision_number}}" name="DecisionNumber">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Lương cơ bản</label>
                        <input type="text" class="form-control" value="{{$temp->basic_salary}}" name="BasicSalary">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea class="form-control" value="{{$temp->note}}" name="Note"></textarea>
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
            @endforeach
        </form>
    </div>
</div>
@endsection