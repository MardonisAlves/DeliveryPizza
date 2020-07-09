<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

use \SlimSession\Helper;
$container = $app->getContainer();

$container['view'] = function ($container) {

    $view = new \Slim\Views\Twig(__DIR__.'/resources/views', ['cache' => false,]);
     $view->getEnvironment()->addGlobal('session', $_SESSION);
    $view->addExtension(new \Slim\Views\TwigExtension(

        $container->router,
        $container->request->getUri()
));


    return $view;

};


//FLASHE MENSSAGE
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};



// Register globally to app
$container['session'] = function () {
  return new \SlimSession\Helper;
};


//UPLOADS IMAGES Hroku
$container = $app->getContainer();
$container['upload_directory'] =  'public/img/uploads/cardapio/';

// DOCTRINE
$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['metadata_dirs'],
       // $settings['doctrine']['meta']['auto_generate_proxies'],
       // $settings['doctrine']['meta']['proxy_dir'],

        $settings['doctrine']['cache_dir'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// PDO MYSQL


$container['mysql'] = function ($c) {
    $settings = $c->get('settings')['mysql'];
    $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'],
    $settings['user'], $settings['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
// HOME CONTROLER
$container['HomeController'] = function ($container) {
return new \App\Controller\HomeController($container  ,
                                            $container['em'],
                                            $container->get('flash'));
};



// ADMINCONTROLLER
$container['AdminController'] = function ($container){
return new App\Controller\AdminController($container ,
                                            $container['em'] ,
                                            $container->get('flash'),
                                            $container['session']);
};

// SenhaController
$container['SenhaController'] = function ($container){
    return new App\Controller\SenhaController($container ,
                                                $container->get('em') ,
                                                $container->get('flash'),
                                                $container->get('session'));
};

// TesteController
$container['TesteController'] = function ($container){
    return new App\Controller\TesteController($container ,
                                                $container['em'],
                                                $container->get('flash'));
};


// ProdutoController
$container['ProdutoController'] = function ($container){
    return new App\Controller\ProdutoController($container ,
                                                $container['em'] ,
                                                $container->get('flash'),
                                                $container->get('session'));
};

// ClienteController

$container['ClienteController'] = function ($container){
    return new App\Controller\ClienteController($container ,
                                                $container['em'],
                                                 $container->get('flash') ,
                                                 $container->get('session'));
};

// PizzaController
$container['PizzaController'] = function ($container) {
    return new \App\Controller\PizzaController($container  ,
                                                $container['em'] ,
                                                $container->get('flash'),
                                                $container->get('session'));

    };
// CarroController
    $container['CarroController'] = function ($container) {
    return new \App\Controller\CarroController($container  ,
                                                $container['em'] ,
                                                $container->get('flash'),
                                                $container->get('session'));

    };
