@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cập nhật tài khoản nhân viên</h3>
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
            <table class="table">
                @foreach($employee as $key => $emp)
                <tr>
                    <th>Mã nhân viên:</th>
                    <td>{{ $emp->employee_code }}</td>
                    <th>Họ và tên:</th>
                    <td>{{ $emp->fullname }}</td>
                </tr>
                @endforeach
                <tr>
                    <th>Tên đăng nhập:</th>
                    <td><input type="text" class="form-control" value="{{ $emp->username }}" name="username"></td>
                    <th>Mật khẩu:</th>
                    <td><input type="password" class="form-control" value="{{ $emp->password }}" name="password"></td>
                </tr>
                <tr>
                    <th>Loại:</th>
                    <td>
                        @if ($emp->type === 'fulltime')
                        <input class="" type="radio" id="fulltime" value="fulltime" name="type" checked>
                        <label class="form-check-label" for="fulltime">Fulltime</label>&ensp; &ensp;
                        <input class="" type="radio" id="parttime" value="parttime" name="type">
                        <label class="form-check-label" for="parttime">Parttime</label>
                        @else
                        <input class="" type="radio" id="fulltime" value="fulltime" name="type">
                        <label class="form-check-label" for="fulltime">Fulltime</label>&ensp; &ensp;
                        <input class="" type="radio" id="parttime" value="parttime" name="type" checked>
                        <label class="form-check-label" for="parttime">Parttime</label>
                        @endif
                    </td>
                    <th>Quyền hạn:</th>
                    <td>
                        @if ($emp->role === 'admin')
                        <input class="" type="radio" id="admin" value="admin" name="role" checked>
                        <label class="form-check-label" for="admin">Admin</label>&ensp; &ensp;
                        <input class="" type="radio" id="member" value="member" name="role">
                        <label class="form-check-label" for="member">Member</label>
                        @else
                        <input class="" type="radio" id="admin" value="admin" name="role">
                        <label class="form-check-label" for="admin">Admin</label>&ensp; &ensp;
                        <input class="" type="radio" id="member" value="member" name="role" checked>
                        <label class="form-check-label" for="member">Member</label>
                        @endif

                    </td>
                </tr>
                <tr align="center">
                    <th colspan="4">
                        <a href="/User" class="btn btn-danger">Hủy</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </th>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection