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
                        'driver'   => 'pgsql',
                        'host'     => 'ec2-3-91-112-166.compute-1.amazonaws.com',
                        'dbname'   => 'dbi2apjua8v7h8',
                        'user'     => 'qkufycndgpityd',
                        'password' => '7ac616e99c17641f38c2acab3426c82ae191f8e2597ddcbd6e7b0fcf10edadf4',
                    ]
                    ],
                    "db" => [
                        "host" => "ec2-3-91-112-166.compute-1.amazonaws.com",
                        "dbname" => "dbi2apjua8v7h8",
                        "user" => "qkufycndgpityd",
                        "pass" => "7ac616e99c17641f38c2acab3426c82ae191f8e2597ddcbd6e7b0fcf10edadf4"
                    ],

            ]
    ];
