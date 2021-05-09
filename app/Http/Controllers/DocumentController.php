<?php

namespace App\Http\Controllers;

use App\Document as Model;
use App\Employee;
use App\Http\Requests\EmployeeRequest as ThisRequest;
use App\Table\EmployeeTable as ThisTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

class DocumentController extends Controller
{

    protected $title_page = 'Danh sách nhân viên';

//    protected $field_form = [
//        'name' => [
//            'label' => 'Họ và tên',
//            'type' => 'text',
//            'required' => true
//        ],
//        'email' => [
//            'label' => 'Email',
//            'type' => 'text',
//            'required' => true
//        ],
//        'phone' => [
//            'label' => 'Số điện thoại',
//            'type' => 'text',
//            'required' => true
//        ],
//        'dob' => [
//            'label' => 'Ngày sinh',
//            'type' => 'date',
//            'required' => true
//        ],
//        'position_id' => [
//            'label' => 'Chức vụ',
//            'type' => 'select',
//            'required' => true,
//            'route' => 'positions.select2',
//        ],
//        'department_id' => [
//            'label' => 'Phòng ban',
//            'type' => 'select',
//            'required' => true,
//            'route' => 'departments.select2',
//        ],
//        'status' => [
//            'label' => 'Trạng thái',
//            'type' => 'status',
//            'required' => true
//        ],
//        'address' => [
//            'label' => 'Địa chỉ',
//            'type' => 'text',
//            'required' => true
//        ],
//        'document' => [
//            'label' => 'Tài liệu',
//            'type' => 'files'
//        ]
//    ];

    public function __construct()
    {
        parent::__construct();
    }

//    public function index(ThisTable $table)
//    {
//        return view('base/view', [
//            'table' => $table->html()
//        ]);
//    }
//
//    public function list(Request $request, ThisTable $table)
//    {
//        return $table->render();
//    }
//
//    public function store(ThisRequest $request)
//    {
//
//        return responseSuccess('Tạo mới thành công');
//    }
//
//    public function edit($id)
//    {
//        return Model::find($id);
//    }
//
//    public function update($id, ThisRequest $request)
//    {
//        $user = Model::find($id);
//        $data = $request->input();
//
//        $user->fill($data);
//        $user->save();
//
//        return responseSuccess('Cập nhật thành công thành công');
//    }
//
//    public function destroy($id)
//    {
//        Model::destroy($id);
//        return responseSuccess('Xoá thành công');
//    }
//
//    public function deletes(Request $request)
//    {
//        $ids = $request->input('ids') ?? [];
//
//        DB::beginTransaction();
//        try {
//
//            foreach ($ids as $id) {
//                Model::destroy($id);
//            }
//            DB::commit();
//
//            return responseSuccess('Xoá thành công');
//        } catch (Exception $e) {
//            DB::rollback();
//            return  responseError($e->getMessage());
//        }
//    }

    public function files(Request $request, Model $model)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;

            $file_name = date('H-i-s-d-m-Y-') . $file->getClientOriginalName();

            $file->move('upload', $file_name);

            $data = [
                'name' => $file->getClientOriginalName(),
                'url' =>  'upload/' . $file_name,
                'employee_id' => $request->input('employees_id') ?? 0,
            ];

            $model->fill($data)->save();

            return responseSuccess('Thêm thành công');
        }
        return responseError('');
    }

    public function deleteFiles(Request $request, Model $db)
    {
        $employee = Employee::find($request->input('employees_id'));
        $file = $employee->documents()->where('name', $request->input('name'))->first();

        if (empty($file)) return responseError('');

        if (File::exists($file->url)) {
            File::delete($file->url);
        }
        Model::destroy($file->id);
        return responseSuccess('Xoá thành công');
    }

    public function getFiles($id)
    {
        $employee = Employee::find($id);
        $documents = $employee->documents()->select(['name', 'url'])->get()->toArray();
        $data = [];
        foreach ($documents as $item) {
            $item['size'] = 10;
            $item['is_image'] = explode('/', mime_content_type(public_path($item['url'])))[0] === 'image';
            $item['url'] = asset($item['url']);
            $data[] = $item;
        }
        return [
            'image' => $data,
            'employee' => $employee
        ];
    }
}
