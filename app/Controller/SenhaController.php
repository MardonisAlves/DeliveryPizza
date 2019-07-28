<?php
namespace App\Controller; 

use App\Model\Users;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class SenhaController extends Validate
{
      private $em;
      private $container;
      private $flash;
public function __construct($container ,EntityManager $em ,$flash)
{
          $this->em = $em;
          $this->container=$container;
          $this->flash = $flash;
           parent::__construct($container , $flash);
}

// Recuperar senha
public  function  recu_form(Request $request, Response $response, $args)
{
    return $this->container->view->render(
        $response ,
        'admin/recu_form.twig');
}

public function enviartoken(Request $request, Response $response, $args) 
{
    //echo $_POST['email'];
    // selecionar o user by email
    // criar um token com o email e senha
    // enviar o token por email com o link com method get id=token
    
    

}

}

   
