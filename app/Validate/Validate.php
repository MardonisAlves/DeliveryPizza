<?php
namespace App\Validate; 

use Slim\Views\Twig as View;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

abstract class Validate
{

    
    private $container;
    private $flash;
    public function __construct($container ,$flash)
{
       $this->container=$container;
        $this->flash = $flash;
}    

public function validate(Request $request , Response $response , $flash)
{
  //echo $_COOKIE["email"];
  $this->flash->addMessageNow('msg', 'Acesso não permitido');
  return $messages = $this->flash->getMessages();
                            }

}


 

   
