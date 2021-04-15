<?php
$config = [
    'master' => [
        'type' => 'mysql',
        'host' => 'mysql',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'default'
    ],
    'slave' => [
        'slave1' => [
            'type' => 'mysql',
            'host' => 'mysql',
            'user' => 'root',
            'password' => 'root',
            'dbname' => 'test'
        ]
    ]
];
return $config;