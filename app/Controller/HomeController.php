<?php
namespace App\Controller; 

use Slim\Views\Twig as View;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use App\Model\Users;



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
  // insert cliente

  $user = new Users();
        $this->em->persist($user);
        $user->setFullName($_POST["name"]);
        $user->setEmail($_POST["email"]);
        $user->setTypeUser('cliente');
        $user->setSenha(password_hash($_POST["senha"],PASSWORD_DEFAULT));
        $this->em->flush(); 


       
  // redirect para o login
}
 
}
   
