<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig as View;


 class  Validate
{

public function Valsession()
{
  if(isset($_COOKIE["name"])){
    echo $_COOKIE["name"];
      //$contact =  $this->em->getRepository('App\Model\Contact')->findAll();
      return $this->container->view->render($response ,'admin/home.twig' ,Array( 'contact' => $contact));

  }else{
      echo "Sem Permissão";
      //$this->flash->addMessageNow('msg', 'Você não tem Acesso login');
      //$messages = $this->flash->getMessages();
      //var_dump($messages);
      //return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
}

}
}
