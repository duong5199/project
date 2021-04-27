@extends('layouts.default')
@section('title', '/ Danh sách nhân viên')
@section('title con', '/ Thêm nhân viên')
@section('content')
<div class="container-fluid">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm thông tin nhân viên</h3>
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
    <form role="form" method="POST" action=""  style="margin: 20px">
      {{-- @method('PATCH') --}}
      @csrf
      <table class="table">
        <tr>
          <th>Mã nhân viên: <span style="color:red">(*)</span></th>
          <td><input type="text" class="form-control" placeholder="Mã nhân viên..." name="EmployeeCode"></td>
          <th></th>
          <td></td>
        </tr>
        <tr>
          <th>Họ và tên: <span style="color:red">(*)</span></th>
          <td><input type="text" class="form-control" placeholder="Tên nhân viên..." name="Fullname"></td>
          <th>Giới tính:</th>
          <td>
              <input class="" type="radio" id="male" value="male" name="Gender">
              <label class="form-check-label" for="male">Nam</label>
              <input class="" type="radio" id="female" value="female" name="Gender">
              <label class="form-check-label" for="female">Nữ</label>
              <input class="" type="radio" id="other" value="other" name="Gender">
              <label class="form-check-label" for="other">Khác</label>
          </td>
        </tr>
        <tr>
          <th>Ngày sinh:</th>
          <td><input type="date" class="form-control" name="DOB"></td>
          {{-- <td>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </td> --}}
          <th>Kết hôn:</th>
          <td>
              <input class="" type="checkbox" value="1" name="GetMarried">
              <label class="form-check-label">Đã kết hôn</label>
          </td>
        </tr>
        <tr>
          <th>Nơi sinh:</th>
          <td><input type="text" class="form-control" placeholder="Nơi sinh" name="PlaceOfBirth"></td>
          <th>Quốc tịch:</th>
          <td>
            <select class="form-control select2" style="width: 100%;" name="Nationality">
              @foreach($nationality as $nat2)
                <option value="{{$nat2->data_id}}">{{$nat2->data_name}}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <th>Nguyên quán:</th>
          <td colspan="3"><input type="text" class="form-control" placeholder="Nguyên quán..." name="HomeTown"></td>
        </tr>
        <tr>
          <th>Thường trú:</th>
          <td colspan="3"><input type="text" class="form-control" placeholder="Thường trú..." name="PermanentAddress"></td>
        </tr>
        <tr>
          <th>Chỗ ở hiện nay:</th>
          <td colspan="3"><input type="text" class="form-control" placeholder="Chỗ ở hiện nay..." name="CurrentAddress"></td>
        </tr>
        <tr>
          <th>Số điện thoại:</th>
          <td><input type="text" class="form-control" placeholder="Số điện thoại..." name="PhoneNumber"></td>
          <th>Email:</th>
          <td><input type="text" class="form-control" placeholder="Email" name="Email"></td>
        </tr>
        <tr>
          <th>Dân tộc:</th>
          <td>
            <select class="form-control select2" style="width: 100%;" name="Nation">
              @foreach($nation as $nat1)
                <option value="{{$nat1->data_id}}">{{$nat1->data_name}}</option>
              @endforeach
            </select>
          </td>
          <th>Tôn giáo:</th>
          <td><input type="text" class="form-control" placeholder="Tôn giáo..." name="Religion"></td>
        </tr>
        <tr>
          <th>Số CMND:</th>
          <td><input type="text" class="form-control" placeholder="Số CMND..." name="IdentityCardNumber"></td>
          <th>Ngày cấp:</th>
          <td><input type="date" class="form-control" name="date_of_issue"></td>
        </tr>
        <tr>
          <th>Nơi cấp:</th>
          <td><input type="text" class="form-control" placeholder="Nơi cấp..." name="PlaceOfIssue"></td>
          <th></th>
          <td></td>
        </tr>
        <tr>
          <th>Trình độ học vấn:</th>
          <td><input type="text" class="form-control" placeholder="Trình độ học vấn..." name="AcademicLevel"></td>
          <th></th>
          <td></td>
        </tr>
        <tr>
          <th>Ngày kết nạp Đoàn:</th>
          <td><input type="date" class="form-control" name="DateUnion"></td>
          <th>tại:</th>
          <td><input type="text" class="form-control" placeholder="Nơi kết nạp..." name="PlaceUnion"></td>
        </tr>
        <tr>
          <th>Ngày kết nạp Đảng:</th>
          <td><input type="date" class="form-control" name="DateParty"></td>
          <th>tại:</th>
          <td><input type="text" class="form-control" placeholder="Nơi kết nạp..." name="PlaceParty"></td>
        </tr>
        <tr>
          <th>Ảnh:</th>
          <td colspan="3">
            <div class="">
              <input type="file" id="customFile" name="Img">
              <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
            </div>
          </td>
        </tr>
        <tr align="center">
          <th colspan="4">
            <a href="/Employees" class="btn btn-danger">Hủy</a>
            {{-- <input type="submit" value="Lưu" class="btn btn-success"> --}}
            <button type="submit" class="btn btn-primary">Lưu</button>
          </th>
        </tr>
      </table>
    </form>
  </div>
</div>
@endsection