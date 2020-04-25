<?php
namespace App\Controller;

use App\Model\Users;
use App\Model\Contact;
use App\Model\Pizza;
use App\Model\Produtos;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PDO;

class CarroController
{
      private $db;
      private $container;
      private $flash;
      private $session;
public function __construct($container , $db  , $flash ,$session)
{
          $this->db = $db;
          $this->container=$container;
          $this->flash = $flash;
          $this->session = $session;


}
public function initsession(Request $request, Response $response, $args)
{

/*
* 1 PRIMEIRO CRIAMOS A SESSION INIT DO PRODUTO
*/
    $pizza = new Pizza();
    $pizza->setConnection($this->db);
    $pizza->setContainer($this->container);
    $pizza->setSession($this->session);
    $listaIdcadapio =  $pizza->selectByid( $_GET['id']);

   while ($value = $listaIdcadapio->fetch()) 
   {
     
    $this->session->set('idcarro', $value['id']);
    $this->session->set('nomesabor' , $value['nomesabor']);
    echo $_SESSION['idcarro'] . "<br>";
     // var_dump($value);
  
  
    }
/*
*  2 VERIFICAR SE JA ESTA CADASTRADO , SE NÃO REDIRECIONAR PARA CADASTRO COM (ROUTER)
*  
*/
  $url = $this->container->get('router')->pathFor('home');
  return $response->withStatus(302)->withHeader('Location', $url);

/*
* 3  PROPRIO METODO HOME DO ADMINCONTROLLER IRA DIRECIONAR O CLIENTE PARA O PAINEL HOMECLIENTE
*/

}

public function add(Request $request, Response $response, $args)
{
  

}

public function delete(Request $request, Response $response, $args)
{
  

}
}
