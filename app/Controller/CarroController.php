<?php
namespace App\Controller;

use App\Model\Users;
use App\Model\Contact;
use App\Model\Cardapio;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CarroController
{
      private $db;
      private $container;
      private $flash;
public function __construct($container , $db  , $flash ,$session)
{
          $this->db = $db;
          $this->container=$container;
          $this->flash = $flash;
          $this->session = $session;


}
public function initsession(Request $request, Response $response, $args)
{
//--1 aqui iniciamos as session com o id do produto
   $this->session->set('produto_id', $_GET['id']);

//--2 verificar se ja esta cadastrato , se não cadastrar primeiro
 $url = $this->container->get('router')->pathFor('home');
return $response->withStatus(302)->withHeader('Location', $url);
//--3 Depois redirecionar para a pagina cliente

}

public function add(Request $request, Response $response, $args)
{
  

}

public function delete(Request $request, Response $response, $args)
{
  

}
}
