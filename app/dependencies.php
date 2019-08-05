<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$container = $app->getContainer();

$container['view'] = function ($container) {

    $view = new \Slim\Views\Twig(__DIR__.'/resources/views', ['cache' => false,]);
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


// UPLOADS IMAGES
$container = $app->getContainer();
$container['upload_directory'] = __DIR__ . 'public/img/uploads/';

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
return new App\Controller\AdminController($container , $container->get('em') ,$container->get('flash'));
};

// SenhaController
$container['SenhaController'] = function ($container){
    return new App\Controller\SenhaController($container , $container->get('em') ,$container->get('flash'));
};

// TesteController
$container['TesteController'] = function ($container){
    return new App\Controller\TesteController($container , $container->get('em') ,$container->get('flash'));
};


// BebidaController
$container['BebidaController'] = function ($container){
    return new App\Controller\BebidaController($container , $container->get('em') ,$container->get('flash'));
};



