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
  

  if(isset($_COOKIE["name"])){

  $contact =  $this->em->getRepository('App\Model\Contact')->findAll();
  return $this->container->view->render(
                            $response ,
                            'admin/home.twig' ,
                            Array( 
                              'contact' => $contact));


}else{

   $this->flash->addMessageNow('msg', 'Você não tem acesso a esta Funcionalidade');
  $messages = $this->flash->getMessages();

    return $this->container->view->render(
                            $response ,
                            'index.twig',
                            Array( 
                              'messages' => $messages));
    }
                            }

}


 

   
