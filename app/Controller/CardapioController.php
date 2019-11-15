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
use App\Model\Cardapio;
use App\Model\Produtos;
use DateTime;
use SebastianBergmann\Exporter\Exporter;

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
// index cardapio get form
public  function index(Request $request, Response $response, $args)
{
    $produtos= $this->em->getRepository("App\Model\Produtos")->findAll();
    return $this->container->view->render($response ,
                                                'admin/cardapio/cardapio.twig',
                                                 Array('produtos' => $produtos));
}
// inserir 
public function inserircardapio(Request $request, Response $response, $args)
{

   // getProdutos by id
    $produtos= $this->em->find("App\Model\Produtos", $_POST['idproduto']);
    

    // insert cardapio
    $cardapio =  new Cardapio();
    $cardapio->setName("Calabresa");
    $cardapio->setDate(new DateTime(now));
    $cardapio->setDescricao("Muito boa");
    // rever o campo type
    $cardapio->setPreco(9.9); 
    $cardapio->setTamanho("M");
    $cardapio->setUrlImage("url_imagem");

    $this->em->persist($cardapio);
    $this->em->flush();

    // persisitir as chaves na table produtos_cardapio


    // depois render para view

    

   

   
}
// listar\
public function listarcardapio(Request $request, Response $response, $args)
{
    // array com lista de cardapio
    
    //var_dump($cardapio);
    /*
    return $this->container->view->render($response , 
                                        'cardapio.twig' ,  
                                        Array('cardapios' =>  $cardapios))

    */
    $produtos= $this->em->find("App\Model\Produtos", 1);
   var_export($produtos);  


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