@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Cập nhật thông tin hợp đồng</h3>
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
            @foreach($ContractInfor as $temp)
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
                    <label>Số quyết định</label>
                    <input type="text" class="form-control" value="{{$temp->decision_number}}" name="DecisionNumber">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Loại hợp đồng</label>
                    <select class="form-control select2" style="width: 100%;" name="TypeContract">
                        @foreach($ContractType as $type)
                            @if ($type->contract_type_id === $temp->contract_type_id)
                            <option value="{{$type->contract_type_id}}" selected>{{$type->contract_type_name}}</option>
                            @else
                            <option value="{{$type->contract_type_id}}">{{$type->contract_type_name}}</option>
                            @endif
                        @endforeach
                    </select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Ngày bắt đầu</label>
                    <input type="date" class="form-control" value="{{$temp->effective_date}}" name="EffectiveDate">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Ngày kết thúc</label>
                    <input type="date" class="form-control" value="{{$temp->expiration_date}}" name="ExpirationDate">
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control" value="{{$temp->description}}" name="Description">
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