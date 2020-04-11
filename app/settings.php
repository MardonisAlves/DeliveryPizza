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
                        "host" => "localhost",
                        "dbname" => "deliverypizza",
                        "user" => "root",
                        "pass" => ""
                    ],

                    'postsql' => [
                        "driver"   => "pgsql",
                        "host"     => "ec2-3-91-112-166.compute-1.amazonaws.com",
                        "dbname"   => "dbi2apjua8v7h8",
                        "user"     => "qkufycndgpityd",
                        "password" => "7ac616e99c17641f38c2acab3426c82ae191f8e2597ddcbd6e7b0fcf10edadf4",
                    ]

            ]
    ];
