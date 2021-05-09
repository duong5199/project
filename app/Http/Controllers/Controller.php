<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $field_form = [];

    protected $title_page = 'Page';

    public function __construct()
    {
        $this->renderConfigFormToView();
        $this->passDataToView();
    }

    protected function passDataToView()
    {
        $title_page = $this->title_page;

        app('view')->composer('layouts.default', function ($view) use ($title_page) {

            $view->with([
                'title_page' => $title_page,
            ]);

        });
    }

    protected function renderConfigFormToView()
    {
        $data = $this->field_form;
        $html = '';

        foreach ($data as $key => $item) {
            switch ($item['type']) {
                case 'files':
                    $name = $key ?? '';
                    $html .= view('base/input/files', compact('item', 'name'))->render();
                    break;
                case 'date':
                    $name = $key ?? '';
                    $html .= view('base/input/date', compact('item', 'name'))->render();
                    break;
                case 'select':
                    $name = $key ?? '';
                    $html .= view('base/input/select', compact('item', 'name'))->render();
                    break;
                case 'status':
                    $name = $key ?? '';
                    $html .= view('base/input/status', compact('item', 'name'))->render();
                    break;
                case 'textarea':
                    $name = $key ?? '';
                    $html .= view('base/input/textarea', compact('item', 'name'))->render();
                    break;
                case 'text':
                case 'password':
                case 'number':
                case 'hidden':
                default:
                    $name = $key ?? '';
                    $html .= view('base/input/text', compact('item', 'name'))->render();
            }
        }

        app('view')->composer('layouts.default', function ($view) use ($html) {

            $view->with([
                'form_html' => $html,
            ]);

        });
    }
}
