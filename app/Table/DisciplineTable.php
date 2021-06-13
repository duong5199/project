<?php

namespace App\Table;

use \App\Table\Table as BaseTable;
use App\Discipline as Model;

class DisciplineTable extends BaseTable
{
    protected $search_column = ['code'];

    public function __construct()
    {
        parent::__construct();
    }

    public function fill($item)
    {
        $row = [];

        $row[] = $item->id;
        $row[] = $item->code;
        $row[] = $item->employee->name;
        $row[] = $item->reason;
        $row[] = $item->method;
        $row[] = formatDate($item->created_at);

        return $row;
    }

    public function query()
    {
        $query = Model::select([
            'id',
            'code',
            'employee_id',
            'reason',
            'method',
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
            'code' => [
                'label' => 'Mã KT',
                'data' => 'code',
            ],
            'employee_id' => [
                'label' => 'Nhân viên',
                'data' => 'employee_id',
            ],
            'reason' => [
                'label' => 'Lý do',
                'data' => 'reason',
            ],
            'method' => [
                'label' => 'Hình thức KT',
                'data' => 'method',
            ],
            'created_at' => [
                'label' => 'Ngày tạo',
                'data' => 'created_at',
            ]
        ];
    }

}
