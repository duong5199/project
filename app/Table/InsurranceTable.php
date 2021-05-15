<?php

namespace App\Table;

use \App\Table\Table as BaseTable;
use App\Insurrance as Model;

class InsurranceTable extends BaseTable
{

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
        $row[] = $item->bhxh;
        $row[] = $item->bhyt;
        $row[] = $item->address_active;
        $row[] = formatDate($item->date_active);
        $row[] = formatDate($item->date_expired);
        $row[] = formatDate($item->created_at);

        return $row;
    }

    public function query()
    {
        $query = Model::select([
            'id',
            'code',
            'employee_id',
            'bhxh',
            'bhyt',
            'address_active',
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
            'code' => [
                'label' => 'Mã BH',
                'data' => 'code',
            ],
            'employee_id' => [
                'label' => 'Nhân viên',
                'data' => 'employee_id',
            ],
            'bhxh' => [
                'label' => 'Số BHXH',
                'data' => 'bhxh',
            ],
            'bhyt' => [
                'label' => 'Số BHYT',
                'data' => 'bhyt',
            ],
            'address_active' => [
                'label' => 'Nơi cấp',
                'data' => 'address_active',
            ],
            'date_active' => [
                'label' => 'Ngày cấp',
                'data' => 'date_active',
            ],
            'date_expired' => [
                'label' => 'Ngày hết hạn',
                'data' => 'date_expired',
            ],
            'created_at' => [
                'label' => 'Ngày tạo',
                'data' => 'created_at',
            ]
        ];
    }

}
