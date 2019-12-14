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
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// PDO
$container['pdo'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'],
        $settings['user'], $settings['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// HOME CONTROLER
$container['HomeController'] = function ($container) {
return new \App\Controller\HomeController($container  , $container->get('em') , $container->get('flash'));
};
 // ValidateHomeController
$container['Validate'] = function ($container) {
return  \App\Validate\Validate($container  ,$container->get('flash'));
};


// ADMINCONTROLLER
$container['AdminController'] = function ($container){
return new App\Controller\AdminController($container , 
                                            $container['pdo'] ,
                                            $container->get('flash'),
                                             $container->get('session'));
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
                                                $container['pdo'],
                                                $container->get('flash'),
                                                $container->get('session'));
};


// ProdutoController
$container['ProdutoController'] = function ($container){
    return new App\Controller\ProdutoController($container , 
                                                $container['pdo'] ,
                                                $container->get('flash'),
                                                $container->get('session'));
};

// ClienteController

$container['ClienteController'] = function ($container){
    return new App\Controller\ClienteController($container , $container->get('em') ,$container->get('flash'));
};

// CardapioController
$container['CardapioController'] = function ($container) {

    return new \App\Controller\CardapioController($container  , 
                                                $container->get('pdo') , 
                                                $container->get('flash'),
                                                $container->get('session'));

    };



