<?php

namespace App\Http\Controllers;
use App\User;
use App\Employees;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
class UserController extends Controller
{
    public function ListUser(Request $req){
        $username = $req->session()->get('username');
        $inforLogin = Employees::query()
			->select(
				'employees.employee_code', 
				'employees.fullname',
				'employees.img'
				)
			->JOIN ('user', 'user.employee_id','=','employees.employee_id')
			->WHERE ([
				['user.username', $username],
				['employees.status', 0]
			])
			->get();

        $limit = 10;
        $page            = $req->query('page');
        $numberOfRecords = User::query()->count();
        $numberOfPage    = $numberOfRecords > 0 ? ceil($numberOfRecords / $limit) : 1;
        $users         = User::query()
            ->select('user_id',
                'employees.employee_code',
                'employees.fullname',
                'username',
                'password',
                'role',
                'is_active',
                'type')
            ->JOIN ('employees', 'employees.employee_id', '=', 'user.employee_id')
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();
        return view('user/list_user', [
            'users'             => $users,
            'numberOfRecords'   => $numberOfRecords,
            'page'              => $page,
            'numberOfPage'      => $numberOfPage,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
    public function AddUser(Request $req, $id){
        $username = $req->session()->get('username');
        $inforLogin = Employees::query()
			->select(
				'employees.employee_code', 
				'employees.fullname',
				'employees.img'
				)
			->JOIN ('user', 'user.employee_id','=','employees.employee_id')
			->WHERE ([
				['user.username', $username],
				['employees.status', 0]
			])
			->get();

        $errors = new MessageBag();
        $employee = Employees::query()
            ->select('employee_code', 'fullname')->where('employee_id','=',$id)->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'username'      => 'required|unique:user,username|min:5',
                    'password'          => 'required|min:5'
                ]);
        
                if (!$validator->fails()) {
                    $newUser = new User();
                    $newUser->employee_id = $id;
                    $newUser->username = $req->post('username');
                    $newUser->password = $req->post('password');                
                    $newUser->role = $req->post('role');
                    $newUser->is_active = 'active';    // giá trị mặc định là hoạt động
                    $newUser->type = $req->post('type');
                    $newUser->created_at = Carbon::now();
                    $newUser->save();
                    // var_dump($newEmployee);exit;
                    // Sau khi thêm mới tài khoản nhân viên -> chuyển đến form danh sách tài khoản
                    return redirect('User');
                }
                $errors = $validator->errors();
            }
        return view('user/add_user',[
            'errors'        => $errors,
            'employee'      => $employee,
            'inforLogin'	=> $inforLogin,
            'username'      => $req->session()->get('username')
        ]);
    }

    
    public function EditUser(Request $req, $id){
        $username = $req->session()->get('username');
        $inforLogin = Employees::query()
			->select(
				'employees.employee_code', 
				'employees.fullname',
				'employees.img'
				)
			->JOIN ('user', 'user.employee_id','=','employees.employee_id')
			->WHERE ([
				['user.username', $username],
				['employees.status', 0]
			])
			->get();

        $errors = new MessageBag();
        $employee = Employees::query()
            ->select('employee_code', 'fullname', 'username', 'password', 'role', 'type' )
            ->join('user', 'user.employee_id', '=', 'employees.employee_id')
            ->where('user.user_id','=',$id)->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'username'      => 'required|min:5',
                    'password'          => 'required|min:5'
                ]);
        
                if (!$validator->fails()) {
                    $newUser = User::find($id);
                    $newUser->username = $req->post('username');
                    $newUser->password = $req->post('password');                
                    $newUser->role = $req->post('role');
                    $newUser->type = $req->post('type');
                    $newUser->save();
                    // var_dump($newEmployee);exit;
                    // Sau khi thêm mới tài khoản nhân viên -> chuyển đến form danh sách tài khoản
                    return redirect('User');
                }
                $errors = $validator->errors();
            }
        return view('user/edit_user',[
            'errors'            => $errors,
            'employee'          => $employee,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
}