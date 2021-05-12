<?php

namespace App\Table;

use \App\Table\Table as BaseTable;
use App\Payroll as Model;

class PayrollTable extends BaseTable
{
    protected $view_empty_data = 'payrolls/empty_data';

    protected $action_table = ['edit', 'view', 'send', 'delete'];

    public function __construct()
    {
        parent::__construct();
    }

    public function fill($item)
    {
        $row = [];

        $row[] = $item->id;
        $row[] = $item->employee->name;
//        $row[] = $item->email;
        $row[] = formatDate($item->created_at);

        return $row;
    }

    public function query()
    {
        $query = Model::select([
            'id',
            'month',
            'employee_id',
            'created_at',
        ]);

        if (empty(request()->input('month'))) {
            $query = $query->whereMonth('month', '=', date('m'));
        } else {
            $query = $query->whereMonth('month', '=', explode('-', request()->input('month'))[0]);
        }

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
                'label' => 'Nhân viên',
                'data' => 'employee_id',
            ],
            'created_at' => [
                'label' => 'Ngày tạo',
                'data' => 'created_at',
            ]
        ];
    }

}
