<?php
$menuList = [
    [
        'title' => '',
        'children' => [
            [
                'name' => 'Dashboard',
                'url' => '?controller=site',
                'icon' => 'tf-icons bx bx-home-circle',
            ]
        ]
    ],
    [
        'title' => 'menus',
        'children' => [
            [
                'name' => 'tất cả',
                'url' => '?controller=menu',
                'icon' => 'bx bx-menu',
            ],
            [
                'name' => 'tạo menus',
                'url' => '?controller=menu&action=create',
                'icon' => 'bx bx-add-to-queue',
            ]
        ]
    ],
    [
        'title' => 'banner',
        'children' => [
            [
                'name' => 'tất cả',
                'url' => '?controller=banner',
                'icon' => 'tf-icons bx bx-home-circle',
            ],
            [
                'name' => 'tạo banner',
                'url' => '?controller=banner&action=create',
                'icon' => 'tf-icons bx bx-home-circle',
            ],
            [
                'name' => 'tạo nhóm banner ',
                'url' => '?controller=banner&action=create-group',
                'icon' => 'tf-icons bx bx-home-circle',
            ]
        ]
    ],
    [
        'title' => 'đơn hàng',
        'children' => [
            [
                'name' => 'tất cả',
                'url' => '?controller=order',
                'icon' => 'tf-icons bx bx-home-circle',
            ]
        ]
    ],
    [
        'title' => 'sản phẩm',
        'children' => [
            [
                'name' => 'tất cả',
                'url' => '?controller=product',
                'icon' => 'bx bx-package',
            ],
            [
                'name' => 'tạo sản phẩm',
                'url' => '?controller=product&action=create',
                'icon' => 'tf-icons bx bx-home-circle',
            ],
            [
                'name' => 'tạo tạo danh mục',
                'url' => '?controller=category',
                'icon' => 'tf-icons bx bx-home-circle',
            ],
            [
                'name' => 'tỳ biến',
                'url' => '?controller=attribute&action=customization',
                'icon' => 'tf-icons bx bx-home-circle',
            ],
            [
                'name' => 'thuộc tính',
                'url' => '?controller=attribute',
                'icon' => 'tf-icons bx bx-home-circle',
            ]
        ]
    ],
    [
        'title' => 'tài khoản',
        'children' => [
            [
                'name' => 'tất cả',
                'url' => '?controller=users',
                'icon' => 'tf-icons bx bx-home-circle',
            ],
            [
                'name' => 'tạo tài khoản',
                'url' => '?controller=users&action=create',
                'icon' => 'tf-icons bx bx-home-circle',
            ]
        ]
    ]
];
