<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Slim\Container;


// START SESSION//
/*
session_start();
ini_set("session.gc_maxlifetime", 18000);
$session_life = ini_get("session.gc_maxlifetime");
*/

/**
 *  Slim Application setting
 *  and bootstrapping
 */

// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Application settings

$container =  new Container (require __DIR__ . '/../app/settings.php');

// New Slim app instance
$app = new Slim\App($container);

// Add our dependencies to the container
require __DIR__ . '/../app/dependencies.php';

// Require our route
require __DIR__ . '/../app/Routes/routes.php';

// Controller


return $container;
