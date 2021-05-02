<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use App\Employees;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use App\Table\UserTable;
use mysql_xdevapi\Exception;

class UserController extends Controller
{

    protected $title_page = 'Quản Trị Viên';

    protected $field_form = [
        'name' => [
            'label' => 'Họ và tên',
            'type' => 'text',
            'required' => true
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'required' => true
        ],
        'password' => [
            'label' => 'Mật khẩu',
            'type' => 'password',
            'required' => true
        ]
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index(UserTable $table)
    {
        return view('base/view', [
            'table' => $table->html()
        ]);
    }

    public function list(Request $request, UserTable $table)
    {
        return $table->render();
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->input('name') ?? '',
            'email' => $request->input('email') ?? '',
            'password' => Hash::make($request->input('password') ),
        ]);

        return responseSuccess('Tạo mới thành công');
    }

    public function edit($id)
    {
        return User::find($id);
    }

    public function update($id, UserRequest $request)
    {
        $user = User::find($id);
        $data = $request->input();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($request->input('password') );
        } else {
            unset($data['password']);
        }

        $user->fill($data);
        $user->save();

        return responseSuccess('Cập nhật thành công thành công');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return responseSuccess('Xoá thành công');
    }

    public function deletes(Request $request)
    {
        $ids = $request->input('ids') ?? [];

        DB::beginTransaction();
        try {

            foreach ($ids as $id) {
                User::destroy($id);
            }
            DB::commit();

            return responseSuccess('Xoá thành công');
        } catch (Exception $e) {
            DB::rollback();
            return  responseError($e->getMessage());
        }
    }
}
