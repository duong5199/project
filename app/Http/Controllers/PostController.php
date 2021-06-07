<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest as ThisRequest;
use App\Post as Model;
use App\Table\PostTable as ThisTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $title_page = 'Danh sách bài viết';

    protected $field_form = [
        'name' => [
            'label' => 'Tên bài viết',
            'type' => 'text',
            'required' => true
        ],
        'content' => [
            'label' => 'Nội dung',
            'type' => 'textarea',
            'rows' => 5
        ],
        'status' => [
            'label' => 'Trạng thái',
            'type' => 'status',
            'required' => true
        ],
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
        return Model::find($id);
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
