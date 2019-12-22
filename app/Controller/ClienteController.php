<?php

namespace App\Controller;



use App\Validate\Validate;
use App\Model\Produtos;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\Constraint\Count;
use Doctrine\Common\Collections\ArrayCollection;
use \Psr\Http\Message\StreamInterface;
use Slim\Http\UploadedFile;

class ClienteController
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
// Acesso cliente

public function homecliente(Request $Request, Response $response , $args)
{
    return $this->container->view->render($response ,'homecliente/homecliente.twig');
}
}