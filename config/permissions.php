<?php

namespace Config\Permission;

use Illuminate\Support\Facades\Config;

return [
    'access' => [
        'category-list' => 'category_list',
        'menu-list' => 'menu_list'
    ],
    'table_module' => [
        'category',
        'brands',
        'shipping',
        'product',
        'setting',
        'user',
        'role',
        'tag'
    ],
    'module_childrent' => [
        'view',
        'list',
        'create',
        'edit',
        'delete'
    ]
];
