<div id="empty-view" style="margin: 0 auto">
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Không có dữ liệu của tháng này !!!</h3>

            <p> Hãy tạo dữ liệu mới </p>
            <p> Bằng cách click vào nút ở dưới </p>
            <div>
                <button type="submit" name="submit" class="btn btn-warning" data-toggle="modal"
                        id="open-model-render-payroll"
                        data-target="#modal-render-payroll">
                    <i class="fas fa-plus"></i> Tạo dữ liệu
                </button>
            </div>
        </div>
        <!-- /.error-content -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-render-payroll" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 1300px;">
            <div class="modal-content">
                <form id="form-render-payroll" method="POST" action="{{ route('payrolls.render') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới</h5>
                        <div>
                            <button type="submit" class="btn btn-primary float-right">Lưu</button>
                            <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Đóng
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" value="" name="month" id="month-payroll">

                        <?php
                        $config = [
                            'days' => [
                                'label' => 'Số ngày công trong tháng - Mặc định 22 ngày',
                                'type' => 'text',
                                'required' => true,
                                'value' => 22
                            ],
                            // 'ot_ratio' => [
                            //     'label' => 'Hệ số lương làm thêm - Mặc định x2',
                            //     'type' => 'text',
                            //     'required' => true,
                            //     'value' => 2
                            // ],
                        ]
                        ?>

                        <div class="card-header row">
                            @forelse($config as $k => $item)
                                <div class="col-md-6">
                                    {!! view('base/input/'. $item['type'], [
                                        'item' => $item,
                                        'name' => $k
                                    ])->render() !!}
                                </div>
                            @empty
                            @endforelse
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body p-0" style="display: block;">
                                            <ul class="nav nav-pills flex-column">
                                                @php( $employees = \App\Employee::select(['*'])->where('status', 1)->get() )

                                                @forelse($employees as $key => $employee)
                                                    <li class="nav-item ">
                                                        <a class="nav-link {{ $key ? '' : 'active' }}"
                                                           data-id="{{ $employee->id }}"
                                                           data-toggle="pill"
                                                           href="#employee_{{ $key }}"
                                                           role="tab"
                                                           aria-controls="employee_{{ $key }}" aria-selected="true">
                                                            {{ $employee->name }}
                                                        </a>
                                                    </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <div class="tab-content" id="pills-tabContent">

                                                @forelse($employees as $key => $employee)

                                                    <?php
                                                    $config = [
                                                        'salary' => [
                                                            'label' => 'Lương cơ bản (VNĐ)',
                                                            'type' => 'text',
                                                            'required' => true,
                                                            'value' => $employee->salary
                                                        ],
                                                        'allowance' => [
                                                            'label' => 'Phụ cấp (VNĐ)',
                                                            'type' => 'text',
                                                            'required' => true,
                                                            'value' => $employee->allowance
                                                        ],
                                                        'workdays' => [
                                                            'label' => 'Số ngày công đã làm (Ngày) - Mặc định 22 ngày',
                                                            'type' => 'text',
                                                            'value' => 22
                                                        ],
                                                        'ot_hours' => [
                                                            'label' => 'Giờ làm thêm (Giờ)',
                                                            'type' => 'text',
                                                            'value' => 0
                                                        ],
                                                        'ot_ratio' => [
                                                            'label' => 'Giờ làm thêm ngày lễ (Giờ)',
                                                            'type' => 'text',
                                                            'value' => 0
                                                        ],
                                                        'owed_salary' => [
                                                            'label' => 'Tạm ứng (VNĐ)',
                                                            'type' => 'text',
                                                            'value' => 0
                                                        ],

                                                    ]
                                                    ?>

                                                    <div class="tab-pane fade {{ $key ? '' : 'show active' }}"
                                                         id="employee_{{ $key }}" role="tabpanel"
                                                         aria-labelledby="pills-home-tab">

                                                        <input type="hidden" name="employee[{{$key}}][id]"
                                                               value="{{ $employee->id }}">

                                                        @forelse($config as $k => $item)
                                                            {!! view('base/input/'. $item['type'], [
                                                                'item' => $item,
                                                                'name' => 'employee['.$key.']['.$k.']'
                                                            ])->render() !!}
                                                        @empty
                                                        @endforelse


                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
