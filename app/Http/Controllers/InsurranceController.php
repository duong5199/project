<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsurranceRequest as ThisRequest;
use App\Insurrance as Model;
use App\Table\InsurranceTable as ThisTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InsurranceController extends Controller
{
    protected $title_page = 'Danh sách bảo hiểm';

    protected $field_form = [
        'code' => [
            'label' => 'Mã số',
            'type' => 'text',
            'required' => true
        ],
        'employee_id' => [
            'label' => 'Nhân viên',
            'type' => 'select',
            'required' => true,
            'route' => 'employees.select2',
        ],
        'bhxh' => [
            'label' => 'Số BHXH',
            'type' => 'text',
            'required' => true
        ],
        'bhyt' => [
            'label' => 'Số BHYT',
            'type' => 'text',
            'required' => true
        ],
        'address_active' => [
            'label' => 'Nơi cấp',
            'type' => 'text',
            'required' => true
        ],
        'date_active' => [
            'label' => 'Ngày cấp',
            'type' => 'date',
            'required' => true
        ],
        'date_expired' => [
            'label' => 'Ngày hết hạn',
            'type' => 'date',
            'required' => true
        ],
        'status' => [
            'label' => 'Trạng thái',
            'type' => 'status',
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

    public function load(Request $request)
    {
        $search = $request->input('q') ?? '';
        return Model::select(['id', 'name as text'])
            ->where('name', 'LIKE', '%'. $search .'%')
            ->get()
            ->toArray();
    }


    public function store(ThisRequest $request, Model $model)
    {
        $data = $request->all();
        $data['date_active'] = formatDateSave($data['date_active']);
        $data['date_expired'] = formatDateSave($data['date_expired']);
        $data['status'] = $request->input('status') ? 1 : 0;
        $model->fill($data);
        $model->save();

        return responseSuccess('Tạo mới thành công');
    }

    public function edit($id)
    {
        $data = Model::find($id);
        $data->employee_id = $data->employee()->select(['id', 'name as text'])->get()->toArray();
        $data->date_active = formatDate($data->date_active);
        $data->date_expired = formatDate($data->date_expired);
        return $data->toArray();
    }

    public function update($id, ThisRequest $request)
    {
        $user = Model::find($id);
        $data = $request->input();
        $data['date_active'] = formatDateSave($data['date_active']);
        $data['date_expired'] = formatDateSave($data['date_expired']);
        $data['status'] = $request->input('status') ? 1 : 0;
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
