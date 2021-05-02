<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest as ThisRequest;
use App\Department as Model;
use App\Table\DepartmentTable as ThisTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $title_page = 'Danh sách phòng ban';

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

    public function index(ThisTable $table)
    {
        return view('base/view', [
            'table' => $table->html()
        ]);
    }

    public function list(Request $request, ThisTable $table)
    {
        return $table->render();
    }

    public function store(ThisRequest $request)
    {

        return responseSuccess('Tạo mới thành công');
    }

    public function edit($id)
    {
        return Model::find($id);
    }

    public function update($id, ThisRequest $request)
    {
        $user = Model::find($id);
        $data = $request->input();

        $user->fill($data);
        $user->save();

        return responseSuccess('Cập nhật thành công thành công');
    }

    public function destroy($id)
    {
        Model::destroy($id);
        return responseSuccess('Xoá thành công');
    }

    public function deletes(Request $request)
    {
        $ids = $request->input('ids') ?? [];

        DB::beginTransaction();
        try {

            foreach ($ids as $id) {
                Model::destroy($id);
            }
            DB::commit();

            return responseSuccess('Xoá thành công');
        } catch (Exception $e) {
            DB::rollback();
            return  responseError($e->getMessage());
        }
    }
}
