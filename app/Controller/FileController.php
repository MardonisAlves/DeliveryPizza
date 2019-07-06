<?php

namespace App\Controller;

use Slim\Views\Twig as View;
use App\Model\Contact;
use App\Model\Users;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class FileController 
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

public function file(Request $request, Response $response, $args)
  {

      // Get form do Uplodad return  view

   $ echo "VIEW UPLPOADS";
  


  }
public function Uploads(Request $req , Response $res , $args)
  {
    // Receber os dados do form do produto com uplodas das images  

    // fazer o merge no banco de dados
  }

}