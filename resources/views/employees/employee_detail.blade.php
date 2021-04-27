@extends('layouts.default')
@section('title', '/ Danh sách nhân viên')
@section('title con', '/ Xem chi tiết')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="background-color: #E6E6FA">
                <div class="card-body"  style="font-size:20px">
                    @foreach ($employeesDetail as $item)
                    <div class="tab-content" >
                        <div class="text-center">
                            @if ($item->img !== '')
                            <img class="img-circle img-bordered-sm" style="width: 200px"
                                src="{{ asset('/dist/img/Anh_The/'.$item->img)}}" alt="user image">
                            @else
                            <img class="img-circle img-bordered-sm" style="width: 200px"
                                src="{{ asset('/dist/img/Anh_The/user.png')}}" alt="user image">
                            @endif
                        </div>
                        <h3 class="profile-username text-center">{{$item->fullname}}</h3>
                        <div class="card-body">
                            <!-- <i class="fas fa-map-marker-alt mr-1"></i> -->
                            <hr>
                            Mã nhân viên
                            <a class="float-right">{{$item->employee_code}}</a>
                            <hr>
                            Email
                            <a class="float-right">{{$item->email}}</a>
                            <hr>
                            Số điện thoại
                            <a class="float-right">{{$item->phone_number}}</a>
                            <hr>
                            Giới tính
                            <a class="float-right">
                              @if ($item->gender === 'male')
                                Nam
                              @elseif ($item->gender === 'female')
                                Nữ
                              @else
                                Khác
                              @endif
                            </a>
                            <hr>
                            Trạng thái hôn nhân
                            <a class="float-right">
                              @if ($item->get_married === 1)
                                Đã kết hôn
                              @else
                                Độc thân
                              @endif
                            </a>
                            <hr>
                            Ngày sinh
                            <a class="float-right">{{ \Carbon\Carbon::parse($item->dob)->format('d/m/Y')}}</a>
                            <hr>
                            <!-- Ngày vào làm
                            <a class="float-right">{{$item->dob}}</a>
                            <hr>
                            Ngày nghỉ việc
                            <a class="float-right">{{$item->dob}}</a>
                            <hr> -->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <style>
        @media (max-width: 768px) {
            .divUserTable {
                overflow-x: scroll;
            }
        }
        </style>
        <div class="col-md-8">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs divUserTable nav-ul-custom" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item nav-li-custom">
                            <a class="nav-link active" id="general-information-tab" data-toggle="pill"
                                href="#general-information" role="tab" aria-controls="general-information"
                                aria-selected="true">Thông tin chung</a>
                        </li>
                        <li class="nav-item nav-li-custom">
                            <a class="nav-link" id="family-relationship-tab" data-toggle="pill"
                                href="#family-relationship" role="tab" aria-controls="family-relationship"
                                aria-selected="false">Quan hệ gia đình</a>
                        </li>
                        <li class="nav-item nav-li-custom">
                            <a class="nav-link" id="working-process-tab" data-toggle="pill" href="#working-process"
                                role="tab" aria-controls="working-process" aria-selected="false">Quá trình công tác</a>
                        </li>
                        <li class="nav-item nav-li-custom">
                            <a class="nav-link" id="salary-process-tab" data-toggle="pill" href="#salary-process"
                                role="tab" aria-controls="salary-process" aria-selected="false">Quá trình lương</a>
                        </li>
                        <li class="nav-item nav-li-custom">
                            <a class="nav-link" id="contract-tab" data-toggle="pill" href="#contract" role="tab"
                                aria-controls="contract" aria-selected="false">Hợp đồng</a>
                        </li>
                        <li class="nav-item nav-li-custom">
                            <a class="nav-link" id="insurrance-tab" data-toggle="pill" href="#insurrance" role="tab"
                                aria-controls="insurrance" aria-selected="false">Bảo hiểm</a>
                        </li>
                        <li class="nav-item nav-li-custom">
                            <a class="nav-link" id="praise-tab" data-toggle="pill" href="#praise" role="tab"
                                aria-controls="praise" aria-selected="false">Khen thưởng</a>
                        </li>
                        <li class="nav-item nav-li-custom">
                            <a class="nav-link" id="discipline-tab" data-toggle="pill" href="#discipline" role="tab"
                                aria-controls="discipline" aria-selected="false">Kỷ luật</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="general-information" role="tabpanel"
                            aria-labelledby="general-information-tab">
                            {{-- Thông tin chung --}}
                            <div>
                                <form>
                                    <table class="table">
                                        <tr>
                                            <th>Mã nhân viên:</th>
                                            <td>{{$item->employee_code}}</td>
                                            <th>Trạng thái:</th>
                                            <td>
                                                @if ($item->status === 1)
                                                Đang làm việc
                                                @else
                                                Đã nghỉ việc
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Họ và tên:</th>
                                            <td>{{$item->fullname}}</td>
                                            <th>Giới tính:</th>
                                            <td>
                                                @if ($item->gender === 'male')
                                                Nam
                                                @elseif ($item->gender === 'female')
                                                Nữ
                                                @else
                                                Khác
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Ngày sinh:</th>
                                            <td>{{ \Carbon\Carbon::parse($item->dob)->format('d/m/Y')}}</td>
                                            <th>Kết hôn:</th>
                                            <td>
                                                @if ($item->get_married === 1)
                                                Đã kết hôn
                                                @else
                                                Độc thân
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nơi sinh:</th>
                                            <td>{{$item->place_of_birth}}</td>
                                            <th>Quốc tịch:</th>
                                            <td>{{$item->quoctich}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nguyên quán:</th>
                                            <td>{{$item->home_town}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Thường trú:</th>
                                            <td>{{$item->permanent_address}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Chỗ ở hiện nay:</th>
                                            <td>{{$item->current_address}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Số điện thoại:</th>
                                            <td>{{$item->phone_number}}</td>
                                            <th>Email:</th>
                                            <td>{{$item->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Dân tộc:</th>
                                            <td>{{$item->dantoc}}</td>
                                            <th>Tôn giáo:</th>
                                            <td>{{$item->religion}}</td>
                                        </tr>
                                        <tr>
                                            <th>Số CMND:</th>
                                            <td>{{$item->identity_card_number}}
                                            </td>
                                            <th>Ngày cấp:</th>
                                            <td>
                                            {{ \Carbon\Carbon::parse($item->date_of_issue)->format('d/m/Y')}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nơi cấp:</th>
                                            <td>{{$item->place_of_issue}}</td>
                                            <th></th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Trình độ văn hóa:</th>
                                            <td>{{$item->academic_level}}</td>
                                            <th></th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Ngày kết nạp Đoàn:</th>
                                            <td>{{$item->date_union}}</td>
                                            <th>tại: </th>
                                            <td>{{$item->place_union}}</td>
                                        </tr>
                                        <tr>
                                            <th>Ngày kết nạp Đảng:</th>
                                            <td>{{$item->date_party}}</td>
                                            <th>tại:</th>
                                            <td>{{$item->place_party}}</td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="family-relationship" role="tabpanel"
                            aria-labelledby="family-relationship-tab">
                            {{-- Quan hệ gia đình --}}
                            <!-- <form role="form" method="POST" action="">
                              @csrf
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Họ tên thân nhân</label>
                                    <input type="text" class="form-control" placeholder="Họ tên thân nhân ..." value="" name="fullname">>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Mối quan hệ</label>
                                    <input type="text" class="form-control" placeholder="Mối quan hệ ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Năm sinh</label>
                                    <input type="text" class="form-control" placeholder="Năm sinh ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nơi sinh</label>
                                    <input type="text" class="form-control" placeholder="Nơi sinh ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Địa chỉ tạm trú</label>
                                    <input type="text" class="form-control" placeholder="Địa chỉ tạm chú ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nơi ở hiện tại</label>
                                    <input type="text" class="form-control" placeholder="Nơi ở hiện tại ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nghề nghiệp</label>
                                    <input type="text" class="form-control" placeholder="Nghề nghiệp ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nơi làm</label>
                                    <input type="text" class="form-control" placeholder="Nơi làm ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" placeholder="Số điện thoại ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Số điện thoại cơ quan</label>
                                    <input type="text" class="form-control" placeholder="Số điện thoại cơ quan ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input type="text" class="form-control" placeholder="Ghi chú ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Cập nhật" />
                                  </div>
                                </div>
                              </div>
                            </form> -->
                            <div class="container-fluid" style="margin-bottom: 15px;">
                                <a class="btn btn-primary" href="/employee/addNewRecordsFR/{{ $item->employee_id }}"
                                    role="button">Thêm quan hệ</a>
                            </div>
                            <div class="nav-ul-custom">
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
                                            <th>Thao tác</th>
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
                                            <td>
                                                <a href="/employee/editFR/{{ $item1->family_relationship_id }}"><i
                                                        class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                        title="Cập nhật"></i></a>
                                                <!-- <a href="#"><i class="fas fa-trash"></i></a> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="working-process" role="tabpanel"
                            aria-labelledby="working-process-tab">
                            {{-- Quá trình công tác --}}
                            <!-- <div>
                              <form>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Phòng ban</label>
                                      <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Chức vụ</label>
                                      <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Ngày nhậm chức</label>
                                      <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Ngày kết thúc</label>
                                      <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Tên công ty</label>
                                      <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Địa chỉ</label>
                                      <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Ghi chú</label>
                                      <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="submit" class="btn btn-primary" value="Cập nhật" />
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div> -->
                            <div class="container-fluid" style="margin-bottom: 15px;">
                                <a class="btn btn-primary" href="/employee/addNewRecords/{{ $item->employee_id }}"
                                    role="button">Thêm quá trình</a>
                            </div>
                            <div class="nav-ul-custom">
                                <form action="" method="post">
                                    <table class="table">
                                        <thead>
                                            <th style="width: 20px">#</th>
                                            <th>Phòng ban</th>
                                            <th>Chức vụ</th>
                                            <th>Ngày nhận chức</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Tên công ty</th>
                                            <th>Địa chỉ</th>
                                            <th>Ghi chú</th>
                                            <th>Thao tác</th>
                                        </thead>
                                        @foreach ($work_process as $key2 => $item2)
                                        <tbody>
                                            <td>{{$key2 + 1 }}</td>
                                            <td>{{$item2->department_name}}</td>
                                            <td>{{$item2->position_name}}</td>
                                            <td>
                                            {{ \Carbon\Carbon::parse($item2->start_date)->format('d/m/Y')}}
                                            </td>
                                            <td>
                                            {{ \Carbon\Carbon::parse($item2->end_date)->format('d/m/Y')}}
                                            </td>
                                            <td>{{$item2->company_name}}</td>
                                            <td>{{$item2->company_address}}</td>
                                            <td>{{$item2->note}}</td>
                                            <td>
                                                @if ($item2->status === 0)
                                                <a href="/employee/editWP/{{ $item2->work_process_id }}"><i
                                                        class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                        title="Cập nhật"></i></a>
                                                @else
                                                <i class="nav-icon fas fa-edit" disabled></i>
                                                @endif
                                                <!-- <a href="#"><i class="fas fa-trash"></i></a> -->
                                            </td>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="salary-process" role="tabpanel"
                            aria-labelledby="salary-process-tab">
                            {{-- Quá trình lương --}}
                            <!-- <form>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Số quyết định</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Lương cơ bản</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Cập nhật" />
                                  </div>
                                </div>
                              </div>
                            </form> -->
                            <div class="container-fluid" style="margin-bottom: 15px;">
                                <a class="btn btn-primary" href="/employee/add_salary_process/{{ $item->employee_id }}"
                                    role="button">Thêm quá
                                    trình</a>
                            </div>
                            <div class="nav-ul-custom">
                                <form>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px">#</th>
                                                <th>Số quyết định</th>
                                                <th>Lương cơ bản</th>
                                                <th>Ghi chú</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        @foreach ($salary_process as $key3=>$item3)
                                        <tbody>
                                            <tr>
                                                <td>{{$key3 + 1 }}</td>
                                                <td>{{$item3->decision_number}}</td>
                                                <td>{{number_format($item3->basic_salary)}} VNĐ</td>
                                                <td>{{$item3->note}}</td>
                                                <td>
                                                    @if ($item3->status === 0)
                                                    <a href="/employee/editSP/{{ $item3->salary_process_id }}">
                                                        <i class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                            title="Cập nhật"></i></a>
                                                    @else
                                                    <i class="nav-icon fas fa-edit" disabled></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contract" role="tabpanel" aria-labelledby="contract">
                            {{-- Hợp đồng --}}
                            <!-- <form>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Số quyết định</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Loại hợp đồng</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Ngày bắt đầu</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Ngày kết thúc</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Cập nhật" />
                                  </div>
                                </div>
                              </div>
                            </form> -->
                            <div class="container-fluid" style="margin-bottom: 15px;">
                                <a class="btn btn-primary" href="/employee/add_contract/{{ $item->employee_id }}"
                                    role="button">Thêm hợp đồng</a>
                            </div>
                            <div class="nav-ul-custom">
                                <form>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px">#</th>
                                                <th>Số quyết định</th>
                                                <th>Loại hợp đồng</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Ghi chú</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        @foreach ($contract as $key4=>$item4)
                                        <tbody>
                                            <tr>
                                                <td>{{$key4 + 1 }}</td>
                                                <td>{{$item4->decision_number}}</td>
                                                <td>{{$item4->contract_type_name}}</td>
                                                <td>
                                                {{ \Carbon\Carbon::parse($item4->effective_date)->format('d/m/Y')}}
                                                </td>
                                                <td>
                                                {{ \Carbon\Carbon::parse($item4->expiration_date)->format('d/m/Y')}}
                                                </td>
                                                <td>{{$item4->description}}</td>
                                                <td>
                                                    @if ($item4->status === 0)
                                                    <a href="/employee/editContract/{{ $item4->contract_id }}">
                                                        <i class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                            title="Cập nhật"></i></a>
                                                    @else
                                                    <i class="nav-icon fas fa-edit" disabled></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="insurrance" role="tabpanel" aria-labelledby="insurrance-tab">
                            {{-- Bảo hiểm --}}
                            <!-- <form>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Số BHYT</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Số BHXH</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Ngày cấp BHYT</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Ngày cấp BHXH</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nơi cấp BHYT</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nơi cấp BHXH</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="submit" class="btn btn-primary" value="Cập nhật" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form> -->
                            <div class="container-fluid" style="margin-bottom: 15px;">
                                <a class="btn btn-primary" href="/employee/add_insurrance/{{ $item->employee_id }}"
                                    role="button">Thêm bảo hiểm</a>
                            </div>
                            <div class="nav-ul-custom">
                                <form>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px">#</th>
                                                <th>Số bảo hiểm YT</th>
                                                <th>Ngày cấp BHYT</th>
                                                <th>Nơi cấp BHYT</th>
                                                <th>Số bảo hiểm XH</th>
                                                <th>Ngày cấp BHXH</th>
                                                <th>Nơi cấp BHXH</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        @foreach ($insurrance as $key5=>$item5)
                                        <tbody>
                                            <tr>
                                                <td>{{$key5 + 1 }}</td>
                                                <td>{{$item5->health_insurance_number}}</td>
                                                <td>
                                                {{ \Carbon\Carbon::parse($item->date_of_issue_health)->format('d/m/Y')}}
                                                </td>
                                                <td>{{$item5->place_of_issue_health}}</td>
                                                <td>{{$item5->social_insurance_number}}</td>
                                                <td>{{$item5->date_of_issue_soc}}</td>
                                                <td>{{$item5->place_of_issue_soc}}</td>
                                                <td>
                                                    @if ($item5->status === 0)
                                                    <a href="/employee/editInsurrance/{{ $item5->insurrance_id }}">
                                                        <i class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                            title="Cập nhật"></i></a>
                                                    @else
                                                    <i class="nav-icon fas fa-edit" disabled></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="praise" role="tabpanel" aria-labelledby="praise-tab">
                            {{-- Khen thưởng --}}
                            <!-- <form>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Mã KT</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nội dung KT</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Lý do</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Cập nhật" />
                                  </div>
                                </div>
                              </div>
                            </form> -->
                            <div class="container-fluid" style="margin-bottom: 15px;">
                                <a class="btn btn-primary" href="/employee/add_praise/{{ $item->employee_id }}"
                                    role="button">Thêm thông tin</a>
                            </div>
                            <div class="nav-ul-custom">
                                <form>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px">#</th>
                                                <th>Mã KT</th>
                                                <th>Nội dung KT</th>
                                                <th>Lý do</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        @foreach ($khenthuong as $key6=>$item6)
                                        <tbody>
                                            <tr>
                                                <td>{{$key6 + 1 }}</td>
                                                <td>{{$item6->praise_discipline_code}}</td>
                                                <td>{{$item6->praise_discipline_name}}</td>
                                                <td>{{$item6->praise_discipline_reason}}</td>
                                                <td>
                                                    @if ($item6->status === 0)
                                                    <a href="/employee/editPraise/{{ $item6->praise_discipline_id }}">
                                                        <i class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                            title="Cập nhật"></i></a>
                                                    @else
                                                    <i class="nav-icon fas fa-edit" disabled></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="discipline" role="tabpanel" aria-labelledby="discipline-tab">
                            {{-- Kỷ luật --}}
                            <!-- <form>
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Mã KL</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Nội dung KL</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Lý do</label>
                                    <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Cập nhật" />
                                  </div>
                                </div>
                              </div>
                            </form> -->
                            <div class="container-fluid" style="margin-bottom: 15px;">
                                <a class="btn btn-primary" href="/employee/add_discipline/{{ $item->employee_id }}"
                                    role="button">Thêm thông tin</a>
                            </div>
                            <div class="nav-ul-custom">
                                <form>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px">#</th>
                                                <th>Mã KL</th>
                                                <th>Nội dung KL</th>
                                                <th>Lý do</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        @foreach ($kyluat as $key7=>$item7)
                                        <tbody>
                                            <tr>
                                                <td>{{$key7 + 1 }}</td>
                                                <td>{{$item7->praise_discipline_code}}</td>
                                                <td>{{$item7->praise_discipline_name}}</td>
                                                <td>{{$item7->praise_discipline_reason}}</td>
                                                <td>
                                                    @if ($item7->status === 0)
                                                    <a
                                                        href="/employee/editDiscipline/{{ $item7->praise_discipline_id }}">
                                                        <i class="nav-icon fas fa-edit" data-toggle="tooltip"
                                                            title="Cập nhật"></i></a>
                                                    @else
                                                    <i class="nav-icon fas fa-edit" disabled></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection