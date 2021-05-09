<?php

namespace App\Http\Controllers;

use App\Employee as Model;
use App\Http\Requests\EmployeeRequest as ThisRequest;
use App\Table\EmployeeTable as ThisTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    protected $title_page = 'Danh sách nhân viên';

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
        'phone' => [
            'label' => 'Số điện thoại',
            'type' => 'text',
            'required' => true
        ],
        'dob' => [
            'label' => 'Ngày sinh',
            'type' => 'date',
            'required' => true
        ],
        'position_id' => [
            'label' => 'Chức vụ',
            'type' => 'select',
            'required' => true,
            'route' => 'positions.select2',
        ],
        'department_id' => [
            'label' => 'Phòng ban',
            'type' => 'select',
            'required' => true,
            'route' => 'departments.select2',
        ],
        'status' => [
            'label' => 'Trạng thái',
            'type' => 'status',
            'required' => true
        ],
        'address' => [
            'label' => 'Địa chỉ',
            'type' => 'text',
            'required' => true
        ]
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index(ThisTable $table)
    {
        $html_upload_files = view('base/input/files', [
            'item' => [
                'label' => 'Tài liệu',
                'type' => 'files'
            ],
            'name' => 'document'
        ])->render();

        return view('employees/view', [
            'table' => $table->html(),
            'html_upload_files' => $html_upload_files
        ]);
    }

    public function list(Request $request, ThisTable $table)
    {
        return $table->render();
    }

    public function store(ThisRequest $request)
    {
        $data = $request->all();
        $data['dob'] = formatDateSave($data['dob']);
        $data['status'] = $request->input('status') ? 1 : 0;
        $user = Model::create($data);

        return responseSuccess('Tạo mới thành công', $user);
    }

    public function edit($id)
    {
        $data = Model::find($id);
        $data->position_id = $data->position()->select(['id', 'name as text'])->get()->toArray();
        $data->department_id = $data->department()->select(['id', 'name as text'])->get()->toArray();
        return $data->toArray();
    }

    public function update($id, ThisRequest $request)
    {
        $user = Model::find($id);
        $data = $request->all();
        $data['dob'] = formatDateSave($data['dob']);
        $data['status'] = $request->input('status') ? 1 : 0;

        $user->fill($data);
        $user->save();

        return responseSuccess('Cập nhật thành công');
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

    public function files(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;

            $s = $file->move('upload', $file->getClientOriginalName());

            dd($s);
        }
    }
}
