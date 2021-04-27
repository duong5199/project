@extends('layouts/login')

@section('header-text')
@endsection
@section('content')
<div class="container">
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
        <span>error: </span>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif              
    <div id="container">
        <h1>Đăng nhập</h1>
        <form action="" method="post">
                        @csrf
            <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập">
            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
            <button type="submit"> Đăng nhập  </button>
            <div id="remember-container">
                <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked" />
                <span id="remember">Ghi nhớ mật khẩu</span>
                <span id="forgotten">Quên mật khẩu</span>
            </div>
        </form>
    </div>

    <!-- Forgotten Password Container -->
    <div id="forgotten-container">
        <h1>Forgotten</h1>
        <span class="close-btn">
            <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
        </span>

        <form>
            <input type="email" name="email" placeholder="E-mail">
            <a href="#" class="orange-btn">Get new password</a>
        </form>
    </div>
</div>
<script>
$('#forgotten').click(function() {
    $("#container").fadeOut(function() {
        $("#forgotten-container").fadeIn();
    });
});
</script>
@endsection