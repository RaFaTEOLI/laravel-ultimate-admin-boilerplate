<?php

return [
    'role_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'admin' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'profile' => 'r,d'
        ],
        'subadmin' => [
            'users' => 'c,r,u',
            'profile' => 'r,u'
        ],
    ],
    'user_roles' => [
        'admin' => [
            ['name' => "Admin", "email" => "admin@rafateoli.com", "password" => '123456'],
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
