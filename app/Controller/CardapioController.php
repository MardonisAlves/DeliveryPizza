<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\Cardapio;
use DateTime;
use Illuminate\Support\Facades\Date;

class CardapioController 
{
    protected $db;
    private $container;
    private $flash;
    private $session;
    
    public function __construct($container , $db ,$flash ,  $session)
{
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;

        
}
// index cardapio get form
public  function index(Request $request, Response $response, $args)
{
    return $this->container->view->render($response ,'admin/cardapio/cardapio.twig');
}
// inserir 
public function inserircardapio(Request $request, Response $response, $args)
{

    

    // insert cardapio
    $cardapio =  new Cardapio();
    $cardapio->setConnection($this->db);
    $cardapio->setContainer($this->container);
    $cardapio->setSession($this->session);
    $cardapio->setId(0);
    $cardapio->setNomesabor($_POST['nomesabor']);
    $cardapio->setTamanho($_POST['tamanho']);
    $cardapio->setValor($_POST['valor']);
    $cardapio->setDescricao($_POST['descricao']);
    

 // fazer upload da img do cardapio criar um method para issso
        $directory = $this->container->get('upload_directory');
        $destination  = $directory . $_FILES['urlimg']['name'];
        $move = move_uploaded_file($_FILES['urlimg']['tmp_name'], $destination);

    $cardapio->setUrlimg($destination);
    $cardapio->insert();
        // depois render para view

    

   

   
}
// listar\
public function listarcardapio(Request $request, Response $response, $args)
{
    
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