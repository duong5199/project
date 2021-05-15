<?php

namespace App\Table;

use \App\Table\Table as BaseTable;
use App\Department as Model;

class DepartmentTable extends BaseTable
{

    public function __construct()
    {
        parent::__construct();
    }

    public function fill($item)
    {
        $row = [];

        $row[] = $item->id;
        $row[] = $item->name;
        $row[] = $item->description;
        $row[] = formatDate($item->created_at);

        return $row;
    }

    public function query()
    {
        $query = Model::select([
            'id',
            'name',
            'description',
            'created_at',
        ]);

        $this->baseQuery($query);
    }

    public function column()
    {
        return [
            'id' => [
                'label' => 'ID',
                'data' => 'id',
            ],
            'name' => [
                'label' => 'Tên phòng ban',
                'data' => 'name',
            ],
            'description' => [
                'label' => 'Mô tả',
                'data' => 'description',
            ],
            'created_at' => [
                'label' => 'Ngày tạo',
                'data' => 'created_at',
            ]
        ];
    }

}
