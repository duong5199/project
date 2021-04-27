@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cập nhật thông tin bảo hiểm</h3>
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
            @foreach($insurranceInfor as $temp)
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
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Số BHYT</label>
                        <input type="text" class="form-control" value="{{$temp->health_insurance_number}}"
                            name="HealthNumber">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Số BHXH</label>
                        <input type="text" class="form-control" value="{{$temp->social_insurance_number}}"
                            name="SocInNumber">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ngày cấp BHYT</label>
                        <input type="date" class="form-control" value="{{$temp->date_of_issue_health}}"
                            name="dateHealth">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ngày cấp BHXH</label>
                        <input type="date" class="form-control" value="{{$temp->date_of_issue_soc}}" name="dateSoc">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nơi cấp BHYT</label>
                        <input type="text" class="form-control" value="{{$temp->place_of_issue_health}}"
                            name="placeHealth">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nơi cấp BHXH</label>
                        <input type="text" class="form-control" value="{{$temp->place_of_issue_soc}}" name="placeSoc">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Trạng thái &ensp; &ensp;</label>
                        <input class="" type="radio" id="hieuluc" value="0" name="Status" checked>
                        <label class="form-check-label" for="hieuluc">Hiệu lực</label>&ensp; &ensp;
                        <input class="" type="radio" id="hethieuluc" value="1" name="Status">
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
            @endforeach
        </form>
    </div>
</div>
@endsection