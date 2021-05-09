<?php

namespace App\Table;

use \App\Table\Table as BaseTable;
use App\Employee as Model;

class EmployeeTable extends BaseTable
{

    protected $action_table = ['edit', 'file', 'delete'];

    public function __construct()
    {
        parent::__construct();
    }

    public function fill($item)
    {
        $row = [];

        $row[] = $item->id;
        $row[] = $item->name;
        $row[] = $item->email;
        $row[] = formatDate($item->created_at);

        return $row;
    }

    public function query()
    {
        $query = Model::select([
            'id',
            'name',
            'email',
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
                'label' => 'Họ và tên',
                'data' => 'name',
            ],
            'email' => [
                'label' => 'Email',
                'data' => 'email',
            ],
            'created_at' => [
                'label' => 'Ngày tạo',
                'data' => 'created_at',
            ]
        ];
    }

}
