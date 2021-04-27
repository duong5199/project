@extends('layouts.default')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Cập nhật thông tin loại hợp đồng</h3>
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
            @foreach($conType_detail as $temp)
            <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Mã loại</label>
                            <input type="text" class="form-control" value="{{ $temp->contract_type_code }}"
                                name="conTypeCode">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tên loại</label>
                            <input type="text" class="form-control"  value="{{ $temp->contract_type_name }}"
                                name="conTypeName">
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
                    <a href="/contractType" class="btn btn-danger">Hủy</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                  </div>
                </div>
            </div>
            @endforeach
        </form>
    </div>
</div>
@endsection