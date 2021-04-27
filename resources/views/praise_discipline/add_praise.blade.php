@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm thông tin khen thưởng</h3>
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
            @foreach($employeeInfor as $temp)
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Mã nhân viên</label>
                        <input type="text" class="form-control" value="{{$temp->employee_code}}" disabled>
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
                        <label>Mã KT</label>
                        <input type="text" class="form-control" placeholder="Mã khen thưởng ..." name="PraiseCode">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nội dung KT</label>
                        <input type="text" class="form-control" placeholder="Nội dung khen thưởng ..."
                            name="PraiseName">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Lý do</label>
                        <input type="text" class="form-control" placeholder="Lý do ..." name="PraiseReason">
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