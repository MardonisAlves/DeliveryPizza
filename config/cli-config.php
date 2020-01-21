<?php
// cli-config.php

// Doctrine CLI configuration file Linha de comando com PHP

use Doctrine\ORM\Tools\Console\ConsoleRunner;


$settings = require_once __DIR__.'/../app/app.php';
$settings = $settings['settings']['doctrine'];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $settings['meta']['entity_path'],
    $settings['meta']['auto_generate_proxies'],
    $settings['meta']['proxy_dir'],
    $settings['meta']['cache'],
    false
);

$em = \Doctrine\ORM\EntityManager::create($settings['connection'], $config);

return ConsoleRunner::createHelperSet($em);