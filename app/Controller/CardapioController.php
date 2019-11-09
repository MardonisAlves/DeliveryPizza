<?php

namespace App\Controller;


use App\Model\Contact;
use App\Model\Users;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\Constraint\Count;
use Doctrine\Common\Collections\ArrayCollection;
use App\Model\UsersClientes;


class CardapioController 
{
    protected $em;
    private $container;
    private $flash;
    private $session;
    
    public function __construct($container ,EntityManager $em ,$flash ,  $session)
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;

        
}
// inserir 
public function inserircardapio(Request $request, Response $response, $args)
{
    echo "Listar Produtos para montar o cardapio e depois insrir  no banco de dados";
}
// listar
public function listarcardapio(Request $request, Response $response, $args)
{
    echo "Listar Cardapio e renderizar para view cliente";
}
// atualizar
public function alualizarcardapio(Request $request, Response $response, $args)
{
    
}

// excluir
public function excluircardapio(Request $request, Response $response, $args)
{

}
}