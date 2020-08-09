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
$container['upload_directory'] =  'img/uploads/cardapio/';
$container['upload_directory_categoria'] =  'img/uploads/categoria/';

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
    return new App\Controller\senha\SenhaController($container ,
                                                $container->get('em') ,
                                                $container->get('flash'),
                                                $container->get('session'));
};

// TesteController
$container['TesteController'] = function ($container){
    return new App\Controller\teste\TesteController($container ,
                                                $container['em'],
                                                $container->get('flash'));
};

// PizzaControllerApi
$container['PizzaControllerApi'] = function ($container){
    return new App\Controller\api\PizzaControllerApi($container ,
                                                $container['em'],
                                                $container->get('flash'));
};

// CategoriaControllerApi
$container['CategoriaControllerApi'] = function ($container){
    return new App\Controller\api\CategoriaControllerApi($container ,
                                                $container['em'],
                                                $container->get('flash'));
};


// ProdutoController
$container['ProdutoController'] = function ($container){
    return new App\Controller\produto\ProdutoController($container ,
                                                $container['em'] ,
                                                $container->get('flash'),
                                                $container->get('session'));
};

// ClienteController

$container['ClienteController'] = function ($container){
    return new App\Controller\usuario\ClienteController($container ,
                                                $container['em'],
                                                 $container->get('flash') ,
                                                 $container->get('session'));
};

// PizzaController
$container['PizzaController'] = function ($container) {
    return new \App\Controller\pizza\PizzaController($container  ,
                                                $container['em'] ,
                                                $container->get('flash'),
                                                $container->get('session'));

};

// UserController
$container['UserController'] = function ($container) {
    return new \App\Controller\usuario\UserController($container  ,
                                                $container['em'] ,
                                                $container->get('flash'),
                                                $container->get('session'));
};

// EnderecoController
$container['EnderecoController'] = function ($container) {
    return new \App\Controller\endereco\EnderecoController($container  ,
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



