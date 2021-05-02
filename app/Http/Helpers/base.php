<?php

if (! function_exists('pass_data_to_view')) {
    function pass_data_to_view($data, $layouts = 'layouts.default') {

        app('view')->composer($layouts, function ($view) use ($data) {
            $view->with($data);
        });

    }
}

if (! function_exists('responseSuccess')) {
    function responseSuccess($mess = 'Thành công') {

        return response()->json([
            'type' => 'success',
            'code' => '200',
            'message' => $mess
        ], 200);

    }
}

if (! function_exists('responseError')) {
    function responseError($mess = 'Lỗi') {

        return response()->json([
            'type' => 'error',
            'code' => '500',
            'message' => $mess
        ], 200);

    }
}

if (! function_exists('formatDate')) {
    function formatDate($date, $format = 'd/m/Y') {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (! function_exists('buttonAction')) {
    function buttonAction($item, $action = ['edit', 'delete']) {

        $html = '';
        foreach ($action as $ac) {
            switch ($ac) {
                case 'edit':
                    $html .= view('base/button/edit', compact('item'))->render();
                    break;

                case 'delete':
                    $html .= view('base/button/delete', compact('item'))->render();
                    break;
            }
        }

        return $html;

    }
}

