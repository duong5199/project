<?php

namespace App\Table;

use \App\Table\Table as BaseTable;
use App\Post as Model;

class PostTable extends BaseTable
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
        $row[] = $item->content;
        $row[] = formatDate($item->created_at);

        return $row;
    }

    public function query()
    {
        $query = Model::select([
            'id',
            'name',
            'content',
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
                'label' => 'Tên',
                'data' => 'name',
            ],
            'content' => [
                'label' => 'Content',
                'data' => 'content',
            ],
            'created_at' => [
                'label' => 'Ngày tạo',
                'data' => 'created_at',
            ]
        ];
    }

}
