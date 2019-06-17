<?php

$config = new \Doctrine\DBAL\Configuration();

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
                        'host'     => 'ec2-54-163-230-199.compute-1.amazonaws.com',
                        'dbname'   => 'df5gjbqd0bajje',
                        'user'     => 'zmtywefdmlubee',
                        'password' => '3fca1e8feebd65d3497207ccfde1c490b5d53edb6dd1bb38552a21e8ef02e974',
                    ]
                ]

            ]
    ];

    $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
