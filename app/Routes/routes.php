<?php

    // Creating routes

    // Psr-7 Request and Response interfaces
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    // HOME ROUTE
    $app->get('/', 'HomeController:index')->setName('index');
    $app->get('/servicos', 'HomeController:servicos')->setName('servicos');
    $app->get('/about','HomeController:about')->setName('about');
    $app->get('/contact', 'HomeController:contact')->setName('contact');
    $app->post('/createContact' , 'HomeController:createContact')->setName('createContact');
    $app->get('/CardCliente' ,'HomeController:CardCliente')->setName('CardCliente');
    $app->post('/InserCliente' , 'HomeController:InserCliente')->setName('InserCliente');

    // ADMIN-CONTROLLER
    $app->post('/hometeste', 'AdminController:hometeste')->setName('teste');
    $app->get('/logout', 'AdminController:logout')->setName('logout');
    $app->post('/login', 'AdminController:login')->setName('login')->via('GET','POST');
    $app->get('/newuser', 'AdminController:newuser')->setName('newuser');
    $app->post('/addUser', 'AdminController:addUser')->setName('addUser');
    $app->get('/home', 'AdminController:home')->setName('home');
    $app->get('/GetcontactID', 'AdminController:GetcontactID')->setName('GetcontactID');
    $app->post('/putContact', 'AdminController:putContact')->setName('putContact');
    $app->get('/DeleteContact' , 'AdminController:DeleteContact')->setName('DeleteContact');

    // CarroController
    $app->get('/loginCliente', 'CarroController:logincliente')->setName('logincliente');


    //FileController
    $app->get('/file', 'FileController:file')->setName('file');



