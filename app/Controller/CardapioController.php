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
    
   
    $produtos= $this->em->getRepository("App\Model\Produtos")->findAll();
    // insert cardapio
    // depois render para view

    return $this->container->view->render($response ,
                                         'admin/cardapio/cardapio.twig',
                                          Array('produtos' => $produtos));
}
// listar
public function listarcardapio(Request $request, Response $response, $args)
{
    // array com lista de cardapio
    
    //var_dump($cardapio);
    return $this->container->view->render($response , 
                                        'cardapio.twig' ,  
                                        Array('cardapios' =>  $cardapios));
}
// atualizar
public function alualizarcardapio(Request $request, Response $response, $args)
{
    echo "Atualizar Cardapio e renderizar para view admin";
}

// excluir
public function excluircardapio(Request $request, Response $response, $args)
{
    echo "Excluir Cardapio e renderizar para view admin";
}
}