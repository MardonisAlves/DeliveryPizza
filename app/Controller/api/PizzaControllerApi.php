<?php

namespace App\Controller\api;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Intervention\Image\ImageManager;
use App\Model\Users;
use App\Model\Pizza;
use App\Model\Produtos;
use Pusher\Pusher;

class PizzaControllerApi
{
    protected $em;
    private $container;
    private $flash;

    public function __construct($container ,EntityManager $em ,$flash )
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;
}

/*=================================================================
 *================== METHODS FOR TEST==============================*/



public function listAll(Request  $request, Response $response, $args){
header('Access-Control-Allow-Origin: *'); // Este cabeçalho aceita qualquer requisição

$manager = $this->em->getRepository('\App\Model\Pizza')->findAll();

      $alldata = array();
      foreach($manager as $single){
           $alldata[] = array(
                            'id' => $single->getId(),
                            'nome' =>$single->getNomesabor(),
                            'valorM' => $single->getValorM(),
                            'valorG' => $single->getValorG(),
                            'descricao' => $single->getDescrição(),
                            'urlimg' => $single->getUrlimg());
      }

     

      $response = $response->withHeader('Content-Type', 'application/json');
      $response->write(json_encode($alldata));
      return $response;


}
public function listcardapio(Request  $request, Response $response, $args)
{
    header('Access-Control-Allow-Origin: *'); 
   $pizza = $this->em->getRepository('App\Model\Pizza')->findBy(array('categoria' => $args['categoria']));
    $data = Array();
    foreach ($pizza as $key=> $card) {   
       $data[] = array(
                    'id' => $card->getId(),
                    'nome' =>$card->getNomesabor(),
                    'valorM' => $card->getValorM(),
                    'valorG' => $card->getValorG(),
                    'descricao' => $card->getDescrição(),
                    'urlimg' => $card->getUrlimg()
                );
     }
    $response = $response->withHeader('Content-Type', 'application/json');
        $response->write(json_encode($data));
        return $response;
   
  

}
public function listcardapioId(Request  $request, Response $response, $args)
{
  header('Access-Control-Allow-Origin: *'); 
   $pizza = $this->em->getRepository('App\Model\Pizza')->findBy(array('id' => $args['id']));
    $data = Array();
    foreach ($pizza as $key=> $card) {   
       $data[] = array(
                    'id' => $card->getId(),
                    'nome' =>$card->getNomesabor(),
                    'valorM' => $card->getValorM(),
                    'valorG' => $card->getValorG(),
                    'descricao' => $card->getDescrição(),
                    'urlimg' => $card->getUrlimg()
                );
     }
    $response = $response->withHeader('Content-Type', 'application/json');
        $response->write(json_encode($data));
        return $response; 
}

}
