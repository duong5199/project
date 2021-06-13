<?php

namespace App\Table;

use App\Contract;
use \App\Table\Table as BaseTable;
use App\Contract as Model;

class ContractTable extends BaseTable
{

    public function __construct()
    {
        parent::__construct();
    }

    public function fill($item)
    {
        $row = [];

        $row[] = $item->id;
        $row[] = $item->employee->name;
        $row[] = $item->name;
        $row[] = Contract::LABEL_TYPE($item->type);
        $row[] = formatDate($item->date_active);
        $row[] = formatDate($item->date_expired);
        $row[] = formatDate($item->created_at);

        return $row;
    }

    public function query()
    {
        $query = Model::select([
            'id',
            'employee_id',
            'name',
            'type',
            'date_active',
            'date_expired',
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
            'employee_id' => [
                'label' => 'Nhân viên',
                'data' => 'employee_id',
            ],
            'name' => [
                'label' => 'Tên HĐ',
                'data' => 'name',
            ],
            'type' => [
                'label' => 'Loại HĐ',
                'data' => 'type',
            ],
            'date_active' => [
                'label' => 'Từ ngày',
                'data' => 'date_active',
            ],
            'date_expired' => [
                'label' => 'Đến ngày',
                'data' => 'date_expired',
            ],
            'created_at' => [
                'label' => 'Ngày tạo',
                'data' => 'created_at',
            ]
        ];
    }

}
