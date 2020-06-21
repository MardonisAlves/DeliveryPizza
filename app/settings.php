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
                                'driver' => 'pdo_mysql',
                                'host' => 'ec2-52-20-248-222.compute-1.amazonaws.com',
                                'port' => 5432,
                                'dbname' => 'dsjq5m5njo6sk',
                                'user' => 'kfbozfdgnpidzj',
                                'password' => '838b2a30db248e16000020e724fc21be95b411bd206c2a137f490c13f027dc08'
                            ],


                        ]



                ]
        ];
