<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Slim\Container;




/**
 *  Slim Application setting
 *  and bootstrapping
 */

// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Application settings

$container =  new Container (require __DIR__ . '/../app/settings.php');

// Doctrine orm
$container[EntityManager::class] = function (Container $container): EntityManager {
  $config = Setup::createAnnotationMetadataConfiguration(
      $container['settings']['doctrine']['metadata_dirs'],
      $container['settings']['doctrine']['dev_mode']
  );

  $config->setMetadataDriverImpl(
      new AnnotationDriver(
          new AnnotationReader,
          $container['settings']['doctrine']['metadata_dirs']
      )
  );

  $config->setMetadataCacheImpl(
      new FilesystemCache(
          $container['settings']['doctrine']['cache_dir']
      )
  );

  return EntityManager::create(
      $container['settings']['doctrine']['connection'],
      $config
  );
};

// New Slim app instance
$app = new Slim\App($container);

// Add our dependencies to the container
require __DIR__ . '/../app/dependencies.php';

// Require our route
require __DIR__ . '/../app/Routes/routes.php';

// Controller


$app->add(new \Slim\Middleware\Session([
  'name' => 'dummy_session',
  'autorefresh' => true,
  'lifetime' => '1 hour'
]));

// Run Slim
$app->run();



return $container;





