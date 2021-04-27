@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cập nhật thông tin quan hệ gia đình</h3>
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
            @foreach($FRInfor as $tempFR)
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Mã nhân viên</label>
                        <input type="text" class="form-control" value="{{$tempFR->employee_code}}" name="Id" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tên nhân viên</label>
                        <input type="text" class="form-control" value="{{$tempFR->tennhanvien}}" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Họ tên thân nhân</label>
                        <input type="text" class="form-control" value="{{$tempFR->tennguoithan}}" name="Fullname">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Mối quan hệ</label>
                        <select class="form-control select2" style="width: 100%;" name="Type">
                            @foreach($types as $type)
                            @if ($type->data_id === $tempFR->data_id)
                            <option value="{{$type->data_id}}" selected>{{$type->data_name}}</option>
                            @else
                            <option value="{{$type->data_id}}">{{$type->data_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Năm sinh</label>
                        <input type="text" maxlength="4" class="form-control" value="{{$tempFR->dob}}" name="DOB">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nơi sinh</label>
                        <input type="text" class="form-control" value="{{$tempFR->place_of_birth}}" name="PlaceOfBirth">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Địa chỉ tạm trú</label>
                        <input type="text" class="form-control" value="{{$tempFR->permanent_address}}" name="PermanentAddress">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nơi ở hiện tại</label>
                        <input type="text" class="form-control" value="{{$tempFR->current_address}}" name="CurrentAddress">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nghề nghiệp</label>
                        <input type="text" class="form-control" value="{{$tempFR->job}}" name="Job">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nơi làm</label>
                        <input type="text" class="form-control" value="{{$tempFR->work_address}}" name="WorkAddress">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" value="{{$tempFR->phone_number}}" name="PhoneNumber">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Số điện thoại cơ quan</label>
                        <input type="text" class="form-control" value="{{$tempFR->work_phone_number}}" name="WorkPhoneNumber">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea class="form-control" value="{{$tempFR->note}}" name="Note"></textarea>
                    </div>
                </div>
            </div>
            <div class="row" align="center">
                <div class="col-sm-12">
                    <div class="form-group">
                        <a href="/employee/detail/{{ $tempFR->employee_id }}" class="btn btn-danger">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
            @endforeach
        </form>
    </div>
</div>
@endsection