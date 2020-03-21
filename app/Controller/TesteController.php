<?php

namespace App\Controller;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Intervention\Image\ImageManager;
use App\Model\Users;
use App\Model\Cardapio;

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

public function Ajaxteste(Request  $request, Response $response, $args)
{
    $Cardapio = new Cardapio();
    $Cardapio->setConnection($this->db);
    $Cardapio->setContainer($this->container);
     $listaIdcadapio =  $Cardapio->selectByid( $_GET['q']);

    foreach ($listaIdcadapio as $key => $value) {
       echo  $value['id'];
       echo $value['nomesabor'];
    }


}




}
