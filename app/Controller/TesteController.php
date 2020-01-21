<?php

namespace App\Controller;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\Users;

class TesteController
{
    protected $db;
    private $container;
    private $flash;
    private $session;
    
    public function __construct($container , $db ,$flash ,  $session )
{
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;     
}

/*=================================================================
 *================== METHODS FOR TEST==============================*/

public function Teste(Request  $request, Response $response, $args)
{

    $Users = new Users();
    $Users->setConnection($this->db);
    $Users->setSession($this->session);
    $Users->setContainer($this->container);
    $Users->selctUsers($response);


}

public function  Teste_insert(Request  $request, Response $response, $args)
{
     $Users = new Users();
     $Users->setConnection($this->db);
     $Users->setContainer($this->container);
     $Users->setId(0);
     $Users->setEmail("anacarolina@gmail.com");
     $Users->setNome("Ana");
     $Users->setSenha("123");
     $Users->setTipouser("cliente");
     $Users->insert($response);

        
}
}
