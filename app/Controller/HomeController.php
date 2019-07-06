<?php
namespace App\Controller; 

use Slim\Views\Twig as View;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use App\Model\UsersClientes;



class HomeController 
{
      private $em;
      private $container;

public function __construct($container ,EntityManager $em)
{
          $this->em = $em;
          $this->container=$container;
}

public function index(Request $request, Response $response, $args) 
{
// Return os cardapio pizzza
  return $this->container->view->render(
    $response ,
    'index.twig');
}



public function servicos(Request $request, Response $response, $args)
{
  return $this->container->view->render(
    $response ,
    'servicos.twig'); 
}


public function about( $request,  $response) 
{
  return $this->container->view->render(
    $response ,
    'about.twig');
}



public function contact( $request,  $response) 
{
  return $this->container->view->render(
    $response ,
    'contact.twig');
}

public function CardCliente($request,  $response)
{
  return $this->container->view->render(
    $response ,
    'CardCliente.twig');
}

public function InserCliente(Request $request, Response $response, $args)
{
  


  // verificar a senha do post de é igual 
  
  // verificar os canpos vazios


// insert cliente ja esta em funcionamento

  $cliente = new UsersClientes();
        $this->em->persist($cliente);
        $cliente->setFullName($_POST["name"]);
        $cliente->setEmail($_POST["email"]);
        $cliente->setTypeUser('cliente');
        $cliente->setSenha(password_hash($_POST["senha"],PASSWORD_DEFAULT));
        $cliente->setCidade($_POST['cidade']);
        $cliente->setRua($_POST['rua']);
        $cliente->setBairro($_POST['bairro']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setNumero($_POST['numero']);
        $cliente->setReferencia($_POST['referencia']);

        $this->em->flush(); 


       
  // redirect para o login do user view
}


public function clientelogin()
{
  // selecionar o clinte

  // pagina de acesso cliente
}
 
}
   
