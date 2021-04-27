@extends('layouts.default')
<!-- @yield('title') Cham Cong -->
@section('title', '/ Tổng quan')
@section('content')
<div class="container-fluid">   
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Thông tin cơ bản</h5>
                </div>
                @foreach($employees as $key => $employee)
                <div class="card-body">
                    <strong><i class="fas fa-id-card mr-1"></i> Mã nhân viên:</strong>
                    <a class="float-right">{{ $employee->employee_code }}</a>
                    <hr>
                    <strong><i class="fas fa-signature mr-1"></i> Họ tên:</strong>
                    <a class="float-right">{{ $employee->fullname }}</a>
                    <hr>
                    <strong><i class="fas fa-venus-mars mr-1"></i> Giới tính:</strong>
                    <a class="float-right">
                        <!-- {{ $employee->gender }} -->
                        @if ($employee->gender === 'male')
                        Nam
                        @elseif ($employee->gender === 'female')
                        Nữ
                        @else
                        Khác
                        @endif

                    </a>
                    <hr>
                    <strong><i class="fas fa-calendar-week mr-1"></i> Ngày sinh:</strong>
                    <a class="float-right">{{ date('d/m/Y', strtotime($employee->dob)) }}</a>
                    <hr>
                    <strong><i class="fas fa-envelope-open-text mr-1"></i> Email:</strong>
                    <a class="float-right">{{ $employee->email }}</a>
                    <hr>
                    <strong><i class="fas fa-phone-alt mr-1"></i> SĐT:</strong>
                    <a class="float-right">{{ $employee->phone_number }}</a>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Nơi sinh:</strong>
                    <a class="float-right">{{ $employee->place_of_birth }}</a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class=" col-md-6 nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"
                                style="text-align: center;">Chấm công</a></li>
                        <li class="col-md-6 nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"
                                style="text-align: center;">Chi tiết</a></li>
                    </ul>
                </div>
                <div class="card-body">
                @if(\Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ \Session::get('message') }}
                    </div>
                @endif
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form role="form" method="POST" action="#">
                                @csrf
                                @foreach($user_id as $ID)
                                <input type="hidden" name="ID" value="{{$ID->user_id}}">
                                @endforeach
                                <div class="card card-widget widget-user">
                                    <div class="widget-user-header bg-info">
                                        <h3 class="widget-user-username">{{ $employee->fullname }}</h3>
                                        <h5 class="widget-user-desc">{{ $employee->chucvu }}</h5>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2"
                                            src="{{ asset('/dist/img/Anh_The/'.$employee->img)}}" alt="User Avatar">
                                    </div>
                                    <div class="card-footer">
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Time in:</b>
                                                <a class="float-right" id="time">
                                                    @foreach($timeCheckin as $key => $timein)
                                                    {{ date('H:i', strtotime($timein->time_checkin)) }}
                                                    @endforeach
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Time out:</b>
                                                <a class="float-right" id="time">
                                                    @foreach($timeCheckin as $key => $timein)
                                                    {{ date('H:i', strtotime($timein->time_checkout)) }}
                                                    @endforeach
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <!-- <input type="submit" class="btn btn-success btn-block text-uppercase" name="clockin" value="clockin"/> -->
                                        <button class="btn btn-success btn-block text-uppercase" type="submit" id="clock_btn" name="clockin" value="clockin">
                                            <i class="fa fa-arrow-circle-right"></i> Clock IN
                                        </button>
                                    </div>
                                    @foreach($record_id as $idOut)
                                    <input type="hidden" name="idOut" value="{{$idOut->timekeeping_id}}">
                                    @endforeach
                                    <!-- <input type="" name="timeOut" value="{{ date('H:i:s', strtotime(now('Asia/Ho_Chi_Minh'))) }}"> -->
                                    <div class="col-md-6">
                                    @if ($timein->time_checkout === '00:00:00')
                                        <button class="btn btn-danger btn-block text-uppercase" type="submit" id="clock_btn" name="clockout" value="clockout">
                                            <i class="fa fa-arrow-circle-left"></i> Clock Out
                                        </button>
                                    @else
                                        <button class="btn btn-danger btn-block text-uppercase" disabled type="submit" id="clock_btn" name="clockout" value="clockout">
                                            <i class="fa fa-arrow-circle-left"></i> Clock Out
                                        </button>
                                    @endif
                                        
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="timeline">
                            <table class="table">
                                <tr>
                                    <th>Ngày làm việc:</th>
                                    <td>{{$total_present}}</td>
                                </tr>
                                <tr>
                                    <th>Nghỉ phép có lương:</th>
                                    <td>{{$total_paid_leave}}</td>
                                </tr>
                                <tr>
                                    <th>Nghỉ phép không lương:</th>
                                    <td>{{$total_unpaid_leave}}</td>
                                </tr>
                                <tr>
                                    <th>Nghỉ không phép:</th>
                                    <td>{{$total_absent}}</td>
                                </tr>
                                <tr>
                                    <th>Đi muộn (giờ):</th>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th>OT đã duyệt (giờ):</th>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th>OT chưa duyệt (giờ):</th>
                                    <td>2</td>
                                </tr>
                            </table>
                            <div class="col-md-12">
                                <button class="btn btn-outline-info btn-block text-uppercase" type="submit"
                                    id="clock_btn">
                                    <i class="far fa-eye"></i> View attendance calendar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Chi tiết chấm công tháng trước</h5>
                </div>
                <div class="card-body">
                    <strong> Ngày làm việc:</strong>
                    <a class="float-right">20</a>
                    <hr>
                    <strong> Nghỉ phép có lương:</strong>
                    <a class="float-right">1</a>
                    <hr>
                    <strong> Nghỉ phép không lương:</strong>
                    <a class="float-right">1</a>
                    <hr>
                    <strong> Nghỉ không phép:</strong>
                    <a class="float-right">0</a>
                    <hr>
                    <strong> Đi muộn (giờ):</strong>
                    <a class="float-right">0</a>
                    <hr>
                    <strong> OT (giờ):</strong>
                    <a class="float-right">1.5</a>
                    <hr>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sự kiện</h4>
                    </div>
                    <div class="card-body">
                        <!-- the events -->
                        <div id="external-events">
                            <div class="external-event bg-success">Ngày lễ</div>
                            <div class="external-event bg-warning">Sự kiện</div>
                            <div class="external-event bg-info">Yêu cầu</div>
                            <div class="external-event bg-primary">Cuộc họp</div>
                            <div class="external-event bg-danger">Sinh nhật</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection