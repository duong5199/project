@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm thông tin quan hệ gia đình</h3>
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
                        <label>Mã nhân viên:</label>
                        <input type="text" class="form-control" value="{{$temp->employee_code}}" name="Id" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tên nhân viên:</label>
                        <input type="text" class="form-control" value="{{$temp->fullname}}" disabled>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Họ tên thân nhân: <span style="color:red">(*)</span></label>
                        <input type="text" class="form-control" placeholder="Họ tên thân nhân ..." name="Fullname">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Mối quan hệ: </label>
                        <select class="form-control select2" style="width: 100%;" name="Type">
                            @foreach($types as $type)
                            <option value="{{$type->data_id}}">{{$type->data_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Năm sinh:</label>
                        <input type="text" maxlength="4" class="form-control" placeholder="Năm sinh ..." name="DOB">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nơi sinh:</label>
                        <input type="text" class="form-control" placeholder="Nơi sinh ..." name="PlaceOfBirth">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Địa chỉ tạm trú:</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ tạm chú ..."
                            name="PermanentAddress">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nơi ở hiện tại:</label>
                        <input type="text" class="form-control" placeholder="Nơi ở hiện tại ..." name="CurrentAddress">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nghề nghiệp:</label>
                        <input type="text" class="form-control" placeholder="Nghề nghiệp ..." name="Job">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nơi làm:</label>
                        <input type="text" class="form-control" placeholder="Nơi làm việc ..." name="WorkAddress">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Số điện thoại:</label>
                        <input type="text" class="form-control" placeholder="Số điện thoại ..." name="PhoneNumber">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Số điện thoại cơ quan:</label>
                        <input type="text" class="form-control" placeholder="Số điện thoại cơ quan ..."
                            name="WorkPhoneNumber">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Ghi chú:</label>
                        <textarea class="form-control" placeholder="Ghi chú ..." name="Note"></textarea>
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
        <div class="nav-ul-custom">
            <form>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20px">#</th>
                            <th>Họ và tên</th>
                            <th>Quan hệ</th>
                            <th>Năm sinh</th>
                            <th>Nơi sinh</th>
                            <th>Địa chỉ tạm trú</th>
                            <th>Nơi ở hiện tại</th>
                            <th>Số điện thoại</th>
                            <th>Nghề nghiệp</th>
                            <th>Địa chỉ cơ quan</th>
                            <th>SĐT cơ quan</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    @foreach ($family_relationship as $key1=>$item1)
                    <tbody>
                        <tr>
                            <td>{{$key1 + 1 }}</td>
                            <td>{{$item1->fullname}}</td>
                            <td>{{$item1->data_name}}</td>
                            <td>{{$item1->dob}}</td>
                            <td>{{$item1->place_of_birth}}</td>
                            <td>{{$item1->permanent_address}}</td>
                            <td>{{$item1->current_address}}</td>
                            <td>{{$item1->phone_number}}</td>
                            <td>{{$item1->job}}</td>
                            <td>{{$item1->work_address}}</td>
                            <td>{{$item1->work_phone_number}}</td>
                            <td>{{$item1->note}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </form>
        </div>
    </div>
</div>
@endsection