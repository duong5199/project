@extends('layouts.default')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Thông tin chấm công</h5>
        <div class="card-tools">
            <div class="btn-group">
                <div class="form-inline">
                    <div class="input-group input-group-sm" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="date" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <table id="example1" class="table table-bordered table-striped table-hover ">
                    <thead>
                        <tr align="center" class="table-active">
                            <th style="width: 20px">#</th>
                            <th>Giờ đến</th>
                            <th>Giờ về</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Lý do</th>
                        </tr>
                    </thead>
                    @foreach($detail as $key => $value)
                    <tbody>
                        <tr align="center">
                            <td  style="width:40px">{{$key + 1}}</td>
                            <td  style="width:200">
                            {{ \Carbon\Carbon::parse($value->time_checkin)->format('H:i')}}
                            </td>
                            <td  style="width:200px">
                            {{ \Carbon\Carbon::parse($value->time_checkout)->format('H:i')}}
                            </td>
                            <td  style="width:200px">
                            {{ \Carbon\Carbon::parse($value->date)->format('d/m/Y')}}
                            </td>
                            <td align="left" style="width:230px">
                                @if ($value->status === 0)
                                    <span class="badge badge-pill badge-success" title="Có mặt">Có mặt</span> &emsp;
                                    @if ($value->time_checkin > '08:00:00')
                                        <span class="badge badge-pill badge-info">Muộn</span> &emsp;
                                    @endif
                                    @if ($value->time_checkout < '18:00:00' ) 
                                        <span class="badge badge-pill badge-warning">Sớm</span> &emsp;
                                    @endif
                                @else
                                    <span class="badge badge-pill badge-danger">Vắng mặt</span> 
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                <div class="col-9">{{ $value->reason }} </div>
                                <div class="col-3"><a class="btn btn-primary" href="/Timekeeping_Detail/addReason/{{ $value->timekeeping_id }}" role="button">Lý do</a></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Hiển thị từ 1 đến
                        <select name="example1_length" aria-controls="example1"
                            class="custom-select custom-select-sm form-control form-control-sm"
                            style="width: 60px; font-size: 15px; padding-top: 2px">
                            <option value="10">10</option>
                            <option value="25">20</option>
                            <option value="50">30</option>
                            <option value="100">50</option>
                        </select>
                        của ... kết quả
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection