<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LoginController extends BaseController
{
//http://localhost:8000/login
    public function Login(Request $req)
    {
        $errors = new MessageBag();
        if (!empty($req->post())){
            $validator = Validator::make($req->post(), [
                'username' => 'required|min:5',
                'password' => 'required|min:5'
            ],
            [
                'username.required'     => 'Tên đăng nhập không được để trống!',
                'username.min'          => 'Tên đăng nhập không được ít hơn 5 ký tự!',
                'password.required'     => 'Mật khẩu không được để trống!',
                'password.min'          => 'Mật khẩu không được ít hơn 5 ký tự!',
            ]);
            if (!$validator->fails()) {
                $username = $req->post('username');
                $password = $req->post('password');

                $user = User::query()->where('username', $username)->get();
                if (!empty($user)){
                    // print($user); exit;
                    $user = $user[0];
                    
                    if ($password === $user->password){
                        if ($user->is_active == 'active'){
                            $req->session()->put('isLoggedIn', true);
                            $req->session()->put('role', $user->role);
                            $req->session()->put('username', $username);
                            // return redirect('/Timekeeping');
                            return redirect('/Employees');
                        }else{
                            $errors->add("", "Tài khoản người dùng đã bị khóa!");
                        }
                    }else{
                        $errors->add("", "Mật khẩu không chính xác!");
                    }
                }else{
                    $errors->add("", "Tên đăng nhập không chính xác!");
                }
            }else{
                $errors = $validator->errors();
            }
        }
        return view("login", [
            'errors' => $errors
        ]);
    }

    public function Logout(Request $req){
        $req->session()->flush();
        return redirect('/login');
    }

}
