<?php
return [
    'adminPanel' => [
        'type' => 2,
        'description' => 'Admin Panel',
    ],
    'user' => [
        'type' => 1,
        'description' => 'Сотрудник',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'children' => [
            'user',
            'adminPanel',
        ],
    ],
];
