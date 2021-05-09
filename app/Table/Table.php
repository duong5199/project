<?php


namespace App\Table;


use App\User;
use Illuminate\Pagination\Paginator;

class Table
{

    protected $limit = 10;

    protected $show_action = true;

    protected $action_table = ['edit', 'delete'];

    private $data = [];

    private $column = [];

    public function __construct()
    {
        $this->query();
        $this->column = $this->column() ?? [];
    }

    public function render()
    {
        $list = $this->data;

        $data = [];

        if (!empty($list)) foreach ($list as $item) {
            $row = array();

            $row[] = $item->id;

            $row = array_merge($row, $this->fill($item));

            if ($this->show_action) {
                $action = buttonAction($item, $this->action_table);
                $row[] = $action;
            }

            $data[] = $row;
        }

        $total = $list->toArray()['total'];

        return [
            "draw" => request()->input('draw'),
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data,
        ];
    }

    public function baseQuery($model)
    {
        $params = request()->all();

        if (empty($params)) return $this->data = [];

        $this->column = $this->column();

        $i = 1;
        if (!empty($params['order'])) foreach ($this->column as $key => $item) {
            if ((int)$params['order'][0]['column'] === $i) {
                $model->orderBy($item['data'], $params['order'][0]['dir']);
                break;
            }
            $i++;
        }

        if (!empty($params['search']['value'])) {
            $model->where('name', 'LIKE', '%'. $params['search']['value'] .'%');
        }

        $perPage = $params['length'] ?? $this->limit;
        $currentPage = 1;

        if ($offset = $params['start'])
        {
            $currentPage = ($offset / $perPage) + 1;
        }

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $this->data = $model->paginate($perPage);
    }

    public function html()
    {
        $column = $this->column;
        $action = $this->show_action;

        return view('base.table.table', [
            'column' => $column,
            'action' => $action,
        ])->render();
    }

    public function query()
    {

    }

    public function column()
    {
        return [];
    }

    public function fill($item)
    {
        return [];
    }

}
