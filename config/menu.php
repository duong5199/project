<?php

return [
    [
        'name' => 'Tổng quan',
        'url' => 'home',
        'icon' => 'fas fa-tachometer-alt',
        'child' => []
    ],
    [
        'name' => 'Quản lý tài khoản',
        'url' => 'users.index',
        'icon' => 'fas fa-user',
    ],
    [
        'name' => 'Quản lý nhân viên',
        'url' => 'employees.index',
        'icon' => 'fas fa-user-tie',
    ],
    // [
    //     'name' => 'Quản lý bài viết',
    //     'url' => 'posts.index',
    //     'icon' => 'fas fa-user-tie',
    // ],
    [
        'name' => 'Quản lý danh mục',
        'url' => 'home',
        'icon' => 'fas fa-chess-rook',
        'child' => [
            [
                'name' => 'Quản lý phòng ban',
                'url' => 'departments.index',
            ],
            [
                'name' => 'Quản lý chức vụ',
                'url' => 'positions.index',
            ],
            [
                'name' => 'Quản lý bảo hiểm',
                'url' => 'insurrances.index',
            ],
            [
                'name' => 'Quản lý hợp đồng',
                'url' => 'contracts.index',
            ],
            [
                'name' => 'Quản lý khen thưởng',
                'url' => 'praises.index',
            ],
            [
                'name' => 'Quản lý kỷ luật',
                'url' => 'disciplines.index',
            ],
        ]
    ],
    // [
    //     'name' => 'Quản lý bảo hiểm',
    //     'url' => 'insurrances.index',
    //     'icon' => 'fas fa-coins',
    // ],
    // [
    //     'name' => 'Quản lý phòng ban',
    //     'url' => 'departments.index',
    //     'icon' => 'fas fa-chess-rook',
    // ],
    // [
    //     'name' => 'Quản lý chức vụ',
    //     'url' => 'positions.index',
    //     'icon' => 'fas fa-crosshairs',
    // ],
    [
        'name' => 'Quản lý bảng lương',
        'url' => 'payrolls.index',
        'icon' => 'fas fa-coins',
    ],
];
