<?php

    // Creating routes

    // Psr-7 Request and Response interfaces
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    // HOMECONTROLLER
$app->group('',function(){

$this->get('/', 'HomeController:index')->setName('index');
$this->get('/servicos', 'HomeController:servicos')->setName('servicos');
$this->get('/about','HomeController:about')->setName('about');
$this->get('/contact', 'HomeController:contact')->setName('contact');
$this->map(['POST','GET'],'/createContact' , 'HomeController:createContact')->setName('createContact');
$this->get('/CardCliente' ,'HomeController:CardCliente')->setName('CardCliente');
$this->map(['POST','GET'] ,'/InserCliente' , 'HomeController:InserCliente')->setName('InserCliente');
$this->post('/newcontact','HomeController:newcontact')->setName('newcontact');

});


    // ADMIN-CONTROLLER
    // Request com method multiplo com get post
$app->group('',function(){

    $this->get('/logout', 'AdminController:logout')->setName('logout');
    $this->map(['POST','GET'],'/login', 'AdminController:login')->setName('login');
    $this->get('/newuser', 'AdminController:newuser')->setName('newuser');
    $this->map(['POST','GET'],'/addUser', 'AdminController:addUser')->setName('addUser');
    $this->get('/home', 'AdminController:home')->setName('home');
    $this->get('/GetcontactID', 'AdminController:GetcontactID')->setName('GetcontactID');
    $this->map(['POST','GET'],'/putContact', 'AdminController:putContact')->setName('putContact');
    $this->get('/DeleteContact' , 'AdminController:DeleteContact')->setName('DeleteContact');
    $this->get('/deleteuser' , 'AdminController:deleteuser')->setName('deleteuser');
    $this->get('/listaruser' , 'AdminController:listarUser')->setName('listarUser');
    $this->get('/UpdateUserEndeId', 'AdminController:UpdateUserEndeId')->setName('UpdateUserEndeId');
    $this->post('/updateuserId' ,'AdminController:updateuserId')->setName('updateuserId');
    $this->map(['POST','GET'],'/updateendereco' , 'AdminController:updateendereco')->setName('updateendereco');



});
    // SENHACONTROLLER
    $app->group('',function(){
        $this->map(['GET','POST'],'/recu_form', 'SenhaController:recu_form')->setName('recu_form');
        $this->map(['GET','POST'],'/enviartoken', 'SenhaController:enviartoken')->setName('enviartoken');
        $this->map(['GET','POST'],'/atu_senha', 'SenhaController:atu_senha')->setName('atu_senha');
        $this->map(['GET','POST'],'/updatesenha', 'SenhaController:updatesenha')->setName('updatesenha');
    });

    // TESTECONTROLLER
    $app->group('', function() {
        $this->get('/Teste' , 'TesteController:Teste')->setName('Teste');
        $this->get('/Teste_insert' , 'TesteController:Teste_insert')->setName('Teste_insert');
        $this->get('/deleteuserid' , 'TesteController:deleteuser')->setName('deleteuser');
        $this->get('/EnderecoCliente' , 'TesteController:EnderecoCliente')->setName('EnderecoCliente');
        $this->get('/selctQueybuild' , 'TesteController:selctQueybuild')->setName('selctQueybuild');
        //$this->get('/updateuser', 'TesteController:updateuser')->setName('updateuser');
    });

    // BEBIDACONTROLLER
    $app->group('',function(){
    $this->get('/formbebida' , 'BebidaController:form_bebida')->setName('form_bebida'); 
    $this->post('/insertbebidas' , 'BebidaController:insert_bebidas')->setName('insert_bebidas'); 
    $this->get('/produtos' , 'BebidaController:listar_produto')->setName('listar_produto'); 
    $this->get('/bebida' , 'BebidaController:GetIdBebidas')->setName('GetIdBebidas');
    });

    // CLIENTECONTROLLER
    $app->group('',function(){
        $this->get('/homecliente', 'ClienteController:homecliente')->setName('homecliente');
    });



