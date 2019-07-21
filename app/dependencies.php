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
return new \App\Validate\Validate($container  ,$container->get('flash'));
};


// ADMINCONTROLLER
$container['AdminController'] = function ($container){
return new App\Controller\AdminController($container , $container->get('em') ,$container->get('flash'));
};

// CAROOCONTROLLER
$container['CarroController'] = function ($container) {
return new App\Controller\CarroController($container , $container->get('em') ,$container->get('flash'));
};

// FILECONTROLER
$container['FileController'] = function ($container) {
return new App\Controller\FileController($container , $container->get('em') ,$container->get('flash'));
};

