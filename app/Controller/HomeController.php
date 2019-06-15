<?php
namespace App\Controller; 

use Slim\Views\Twig as View;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;



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
     

      return $this->container->view->render($response ,'index.twig');
   }
   public function servicos(Request $request, Response $response, $args)
   {
      return $this->container->view->render($response ,'servicos.twig'); 
   }

   public function about( $request,  $response) 
   {

         return $this->container->view->render($response ,'about.twig');
   }

   public function contact( $request,  $response) 
   {

         return $this->container->view->render($response ,'contact.twig');
   }

  
   
}