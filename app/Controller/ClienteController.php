<?php

namespace App\Controller;

use App\Model\Produtos;
use App\Model\Pizza;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\StreamInterface;


class ClienteController
{
    protected $db;
    private $container;
    private $flash;
    private $session;
    public function __construct($container ,$db  ,$flash , $session)
{
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;

        

}
// Acesso cliente

public function homecliente(Request $Request, Response $response , $args)
{
	$pizza = new Pizza();
    $pizza->setConnection($this->db);
    $pizza->setContainer($this->container);
    $pizza->setSession($this->session);
   	$lista =  $pizza->selctAll();
    return $this->container->view->render($response ,'homecliente/homecliente.twig' , ['lista' => $lista]);
}
}