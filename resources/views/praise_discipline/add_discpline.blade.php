@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm thông tin kỷ luật</h3>
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
                        <label>Mã KL</label>
                        <input type="text" class="form-control" placeholder="Mã kỷ luật ..." name="DisciplineCode">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nội dung KL</label>
                        <input type="text" class="form-control" placeholder="Nội dung kỷ luật ..."
                            name="DisciplineName">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Lý do</label>
                        <input type="text" class="form-control" placeholder="Lý do ..." name="DisciplineReason">
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