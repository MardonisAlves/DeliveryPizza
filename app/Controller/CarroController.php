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

public function carro(Request $request, Response $response, $args)
{
  //echo $_GET['id'];

for ($i=0 ; $i <= $i ; $i++) { 
  echo $i;
}
}
}