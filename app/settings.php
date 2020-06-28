<?php
    define ('APP_ROOT' , __DIR__);
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

                        'doctrine' => [
                            // if true, metadata caching is forcefully disabled
                            'dev_mode' => true,

                            // path where the compiled metadata info will be cached
                            // make sure the path exists and it is writable
                            'cache_dir' =>  '../doctrine',

                            // you should add any other path containing annotated entity classes
                            'metadata_dirs' =>   ['./app/Model'],

                            'connection' => [
                                'driver' => 'pdo_pgsql',
                                'host' => 'SEU_HOST',
                                'port' => 5432,
                                'dbname' => 'DB_NAME',
                                'user' => 'SEU_USER',
                                'password' => 'SEU_PASSOWRD'
                            ],


                        ]



                ]
        ];
