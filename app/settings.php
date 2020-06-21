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
                                'host' => 'ec2-54-243-195-160.compute-1.amazonaws.com',
                                'port' => 5432,
                                'dbname' => 'd79kpkvd0q2ssh',
                                'user' => 'lvncdgrefyqkcp',
                                'password' => '5656f0de5772eccce3872bec48531f353033bea651c8cc02a1c3ef3a0bd7e937'
                            ]
                        ]



                ]
        ];
