<?php

namespace App\Controller;

use Slim\Views\Twig as View;
use App\Model\Contact;
use App\Model\Users;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class CarroController 
{
    protected $em;
    private $container;
    private $flash;
    public function __construct($container ,EntityManager $em ,$flash)
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;
}
public function logincliente(Request $request, Response $response, $args)
{
    if(isset($_COOKIE['name'])){
      $contact =  $this->em->getRepository('App\Model\Contact')->findAll();
    return $this->container->view->render($response ,'admin/home.twig' ,Array( 'contact' => $contact));
    }else{

    //select o cardapio de pizza
    // criar as sessions
    setcookie("id",1);
    $id = $this->getValidate( $request,  $response, $args);
    return $this->container->view->render($response ,'CardCliente.twig');
    }
}



public function carro(Request $request, Response $response, $args)
{
    
}

public function getValidate($request , $response , $args)
{
if(!isset($_COOKIE["name"])){
  //echo $_COOKIE["email"];
  $this->flash->addMessageNow('msg', 'Você não tem acesso a esta Funcionalidade');
  return $messages = $this->flash->getMessages();
  }
}

}
