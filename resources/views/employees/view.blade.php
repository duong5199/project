@extends('layouts.default')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4 float-right">
                                <button data-action="add" data-label="Thêm mới" class="open-modal-form btn btn-success float-right">Thêm mới</button>
                                <button data-action="add" class="remove-multi btn btn-danger float-right mr-2">Xoá nhiều</button>
                                <button data-action="add" class="reload-table btn btn-primary float-right mr-2">Tải lại</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            {!! $table ?? '' !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('partials.modal-upload-files', compact('html_upload_files'))

    </div>
@endsection


