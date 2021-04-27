@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Thêm thông tin hợp đồng</h3>
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
                    <label>Số quyết định</label>
                    <input type="text" class="form-control" placeholder="Số quyết định ..." name="DecisionNumber">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Loại hợp đồng</label>
                    <select class="form-control select2" style="width: 100%;" name="TypeContract">
                        @foreach($ContractType as $type)
                            <option value="{{$type->contract_type_id}}">{{$type->contract_type_name}}</option>
                        @endforeach
                    </select>
                    <!-- <input type="text" class="form-control" placeholder="Loại hợp đồng ..." name="TypeContract"> -->
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Ngày bắt đầu</label>
                    <input type="date" class="form-control" placeholder="Ngày bắt đầu ..." name="EffectiveDate">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Ngày kết thúc</label>
                    <input type="date" class="form-control" placeholder="Ngày kết thúc ..." name="ExpirationDate">
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea class="form-control"  placeholder="Ghi chú ..." name="Description"></textarea>
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