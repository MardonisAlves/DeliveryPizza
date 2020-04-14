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

            ]
    ];
