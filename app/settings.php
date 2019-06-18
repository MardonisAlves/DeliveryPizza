<?php



    return [

            'settings' => [

                'displayErrorDetails' => true,
                'view' => [
                    'path' => __DIR__ . '/resources/views',
                    'twig' => [
                    'cache' => false
                    ]
                ],

                'doctrine' => [
                    'meta' => [
                        'entity_path' => [
                            'app/Model'
                        ],
                        'auto_generate_proxies' => true,
                        'proxy_dir' =>  __DIR__.'/../cache/proxies',
                        'cache' => null,
                    ],
                    'connection' => [
                        'driver'   => 'pdo_pgsql',
                        'host'     => '',
                        'dbname'   => '',
                        'user'     => '',
                        'password' => '4d0f4d8c0b980122c89540ca7639ef01b0e102df540bb9b93f7d7e59525c19d6',
                    ]
                ]

            ]
    ];
