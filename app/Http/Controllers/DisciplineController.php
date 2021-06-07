<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplineRequest as ThisRequest;
use App\Discipline as Model;
use App\Table\DisciplineTable as ThisTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    protected $title_page = 'Danh sách kỷ luật';

    protected $field_form = [
        'code' => [
            'label' => 'Mã KL',
            'type' => 'text',
            'required' => true
        ],
        'employee_id' => [
            'label' => 'Nhân viên',
            'type' => 'select',
            'required' => true,
            'route' => 'employees.select2',
        ],
        'reason' => [
            'label' => 'Lý do',
            'type' => 'text',
            'required' => true
        ],
        'method' => [
            'label' => 'Hình thức KL',
            'type' => 'text',
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
        $data['status'] = $request->input('status') ? 1 : 0;
        $model->fill($data);
        $model->save();

        return responseSuccess('Tạo mới thành công');
    }

    public function edit($id)
    {
        $data = Model::find($id);
        $data->employee_id = $data->employee()->select(['id', 'name as text'])->get()->toArray();
        return $data->toArray();
    }

    public function update($id, ThisRequest $request)
    {
        $user = Model::find($id);
        $data = $request->input();
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
