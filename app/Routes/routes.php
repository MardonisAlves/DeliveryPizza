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
$this->get('/GetcontactID', 'AdminController:GetcontactID')->setName('GetcontactID');
// update contact
$this->map(['POST','GET'],'/putContact', 'AdminController:putContact')->setName('putContact');
// delete contact
$this->get('/DeleteContact' , 'AdminController:DeleteContact')->setName('DeleteContact');
});

// UserController
$app->group('',function(){
// newuser
$this->get('/newuser', 'UserController:newuser')->setName('newuser');
// addUser metodo insert
$this->map(['POST','GET'],'/addUser', 'UserController:addUser')->setName('addUser');
// delete user
$this->get('/deleteuser/{id}' , 'UserController:deleteuser')->setName('deleteuser');
// listar user
$this->get('/listaruser' , 'UserController:listarUser')->setName('listarUser');
//get form udate User
$this->get('/update/{id}' ,'UserController:getUserform')->setName('update');
// update user
$this->post('/updateuserId' ,'UserController:updateuserId')->setName('updateuserId');
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
$this->get('/user', 'TesteController:user')->setName('user');
$this->map(['DELETE' , 'OPTIONS'] , '/delete/{id}', 'TesteController:deleteuser')->setName('deleteuser');
$this->get('/newtesteCar' , 'TesteController:newtesteCar')->setName('newtesteCar');
$this->get('/deleteByid/{id}' , 'TesteController:deleteByid')->setName('deleteByid');

});

// PizzaControllerApi
$app->group('', function() {
//$this->get('/listAll' , 'PizzaControllerApi:listAll')->setName('listAll');
$this->get('/listAll/{categoria}' , 'PizzaControllerApi:listcardapio')->setName('listcardapio');
$this->get('/listcardapioId/{id}' , 'PizzaControllerApi:listcardapioId')->setName('listcardapioId');
});

// CategoriaControllerApi
$app->group('', function() {
$this->get('/listcategoria' , 'CategoriaControllerApi:listcategoria')->setName('listcategoria');
});

// ENDERECCONTROLLER
$app->group('', function() {
$this->post('/newendereco' , 'EnderecoController:newendereco')->setName('newendereco');
// get form  enedereco by id
$this->get('/updateendeid/{id}', 'EnderecoController:UpdateUserEndeId')->setName('UpdateUserEndeId');
// update endereco user

$this->get('/listcardapioId/{id}')// delete
$this->get('/deleteende', 'EnderecoController:delete')->setName('delete');
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
// listar by id
$this->get('/listarid', 'PizzaController:listarByid')->setName('listarid');
// all pizza
$this->get('/allpiza/{id}' ,'PizzaController:allpiza')->setName('allpiza');
// insert cardapio
$this->post('/insert', 'PizzaController:inserircardapio')->setName('insert');
// atualizar cardapio
$this->post('/atualizar', 'PizzaController:updatePizza')->setName('atualizar');
// excluir cardapio
$this->get('/excluir/{id}', 'PizzaController:excluir')->setName('excluir');

});

// CarroController
$app->group('',function(){
$this->map(['GET','POST'] ,'/initsession', 'CarroController:initsession')->setName('initsession');
});


