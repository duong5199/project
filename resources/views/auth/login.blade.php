@extends('layouts.login')

@section('header-text')
@endsection
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="javascript:;" class="h1"><b>Pro</b>HRM</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Đăng nhập - Quản lí nhân sự</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" autofocus
                               placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection

@section('script')
    <script>
        let alter = false;

        @error('email')
            alter = 'Đăng nhập không thành công';
        @enderror

        @error('password')
            alter = 'Đăng nhập không thành công';
        @enderror

        if (alter) {
            toastr['error'](alter);
        }

    </script>
@endsection
