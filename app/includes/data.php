<?php

$this->constants = [
    'dev' => [
        'BASE_URL' => 'http://localhost/cyberfox/dashboard',
        'HOST' => 'localhost',
        'DB_USER' => 'root',
        'DB_PASS' => '',
        'DB_NAME' => 'cyberfox',
        "DEMO" => true,
        'LINKS' => [
            'blog'  => 'http://localhost/cyberfox/blog',
            'main' => 'http://localhost/cyberfox/main'
        ]
    ],
    'live' => [
        'BASE_URL' => 'https://dashboard.storelad.com',
        'HOST' => 'localhost',
        'DB_USER' => 'storelad_admin',
        'DB_PASS' => 'omo]2R1+4mK6SC',
        'DB_NAME' => 'storelad_main',
        "DEMO" => false,
        'LINKS' => [
            'blog'  => 'https://blog.storelad.com',
            'main' => 'https://storelad.com'
        ]
    ]
    ];
