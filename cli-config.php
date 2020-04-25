<?php

// cli-config.php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Slim\Container;

/** @var Container $container */
$container = require __DIR__ . '/app/app.php';

return ConsoleRunner::createHelperSet($container[EntityManager::class]);