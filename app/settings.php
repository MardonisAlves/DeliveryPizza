<?php
    return [
            'settings' => [

                'displayErrorDetails' => true,
                'determineRouteBeforeAppMiddleware' => false,

                'view' => [
                    'path' => __DIR__ . '/resources/views',
                    'twig' => [
                    'cache' => false
                    ]
                ],

                    "mysql" => [
                        "driver" => "pdo_mysql",
                        "host" => "fdb23.awardspace.net",
                        "dbname" => "3371076_delivery",
                        "user" => "3371076_delivery",
                        "password" => "jk8yup02@!"
                    ],

                    'local' => [
                        "driver"   => "pdo_mysql",
                        "host"     => "localhost",
                        "dbname"   => "deliverypizza",
                        "user"     => "root",
                        "password" => "",
                    ]
                    ,

                    'doctrine' => [
                        // if true, metadata caching is forcefully disabled
                        'dev_mode' => true,
            
                        // path where the compiled metadata info will be cached
                        // make sure the path exists and it is writable
                        'cache_dir' =>  '../doctrine',
            
                        // you should add any other path containing annotated entity classes
                        'metadata_dirs' => ['app//Model'],
            
                        'connection' => [
                            'driver' => 'pdo_mysql',
                            'host' => 'localhost',
                            'port' => 3306,
                            'dbname' => 'test',
                            'user' => 'root',
                            'password' => ''
                        ]
                    ]



            ]
    ];
