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
$this->get('/caizone','HomeController:caizone')->setName('caizone');

});


    // ADMIN-CONTROLLER
    // Request com method multiplo com get post com map
    $app->group('',function(){
        // home
    $this->get('/home', 'AdminController:home')->setName('home');
        // logout
    $this->get('/logout', 'AdminController:logout')->setName('logout');
        // login
    $this->map(['POST','GET'],'/login', 'AdminController:login')->setName('login');
        // newuser
    $this->get('/newuser', 'AdminController:newuser')->setName('newuser');
        // addUser metodo insert
    $this->map(['POST','GET'],'/addUser', 'AdminController:addUser')->setName('addUser');
        // contact by id
    $this->get('/GetcontactID', 'AdminController:GetcontactID')->setName('GetcontactID');
        // update contact
    $this->map(['POST','GET'],'/putContact', 'AdminController:putContact')->setName('putContact');
        // delete contact
    $this->get('/DeleteContact' , 'AdminController:DeleteContact')->setName('DeleteContact');
        // delete user
    $this->get('/deleteuser' , 'AdminController:deleteuser')->setName('deleteuser');
        // listar user
    $this->get('/listaruser' , 'AdminController:listarUser')->setName('listarUser');
        // get form  enedereco by id
    $this->get('/UpdateUserEndeId', 'AdminController:UpdateUserEndeId')->setName('UpdateUserEndeId');
        // new endereco
    $this->get('/newendereco', 'AdminController:newendereco')->setName('Newendereco');
        // update endereco user
    $this->map(['POST','GET'],'/updateendereco' , 'AdminController:updateendereco')->setName('updateendereco');

    //get form udate User
     $this->get('/update' ,'AdminController:getUserform')->setName('update');
    // update user
    $this->post('/updateuserId' ,'AdminController:updateuserId')->setName('updateuserId');




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
        $this->get('/listall' , 'TesteController:listall')->setName('listall');
        $this->get('/list/{id}' , 'TesteController:list')->setName('list');
        $this->post('/user', 'TesteController:user')->setName('user');
        $this->map(['DELETE' , 'OPTIONS'] , '/delete/{id}', 'TesteController:deleteuser')->setName('deleteuser');

    });

    // RestControllerApi
    $app->group('', function() {
        $this->get('/listcardapio' , 'TesteController:listApiCardapio')->setName('listApiCardapio');
});
    // PRODUTOCONTROLLER
    $app->group('',function(){
    $this->get('/formbebida' , 'ProdutoController:form_bebida')->setName('form_bebida');
    $this->post('/inserte' , 'ProdutoController:insertBebidas')->setName('insertBebidas');
    $this->get('/produtos' , 'ProdutoController:listar_produto')->setName('produtos');
    $this->get('/listidproduto' , 'ProdutoController:updateptodutobyId')->setName("updateptodutobyId");
    $this->post('/produtoid' , 'ProdutoController:updateProdutos')->setName('updateProdutos');
    $this->get('/deletarProduto' , 'ProdutoController:deletaProduto')->setName('deletaProduto');
    });

    // CLIENTECONTROLLER
    $app->group('',function(){
        $this->get('/homecliente', 'ClienteController:homecliente')->setName('homecliente');
    });

    // PIZZACONTROLLER
    $app->group('',function(){

        $this->get('/index', 'PizzaController:index')->setName('index');
            // listar cardapio
        $this->get('/viewlistar', 'PizzaController:viewlistar')->setName('viewlistar');
        $this->get('/listar', 'PizzaController:listarcardapio')->setName('listar');
            // listar by id
         $this->get('/listarid', 'PizzaController:listarByid')->setName('listarid');
            // insert cardapio
        $this->post('/insert', 'PizzaController:inserircardapio')->setName('insert');
            // atualizar cardapio
        $this->post('/atualizar', 'PizzaController:updatePizza')->setName('atualizar');
            // excluir cardapio
        $this->get('/excluir', 'PizzaController:excluirpizza')->setName('excluir');

    });

    // CarroController
     $app->group('',function(){

        $this->map(['GET','POST'] ,'/initsession', 'CarroController:initsession')->setName('initsession');

    });
