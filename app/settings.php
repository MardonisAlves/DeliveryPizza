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
                        'host'     => 'ec2-50-19-254-63.compute-1.amazonaws.com',
                        'dbname'   => 'db8s9vh8d24522',
                        'user'     => 'ouqgizhbemfzbl',
                        'password' => 'da2135d9e9e80620c92bc66136e9677b3b2b08be0a7b18f264c80ea425352f2e',
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
