@extends('layouts.default')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="" id="form_filter" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="fa fa-filter"></i>
                                                        </span>
                                                </div>
                                                <input type="text" name="month" value="{{ date('m-Y') }}" class="form-control monthpicker item" placeholder="Tháng">
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 float-right">
                                <button data-action="deletes" class="remove-multi btn btn-danger float-right mr-2">
                                    Xoá nhiều
                                </button>
                                <button data-action="send-multi" class="send-multi btn btn-warning float-right mr-2">
                                    Gửi nhiều
                                </button>
                                <button data-action="reload" class="reload-table btn btn-primary float-right mr-2">
                                    Tải lại
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <div class="row" id="view-table">

                            {!! $table ?? '' !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


