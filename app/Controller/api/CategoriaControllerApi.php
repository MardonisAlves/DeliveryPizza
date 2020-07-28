<?php

namespace App\Controller\api;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Intervention\Image\ImageManager;
use App\Model\Pizza;
use App\Model\Categorias;
use Pusher\Pusher;

class CategoriaControllerApi
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
 *================== METHODS FOR API==============================*/

public function listcategoria(Request  $request, Response $response, $args){
header('Access-Control-Allow-Origin: *'); 
$categorias = $this->em->getRepository('\App\Model\Categorias')->findAll();
      $alldata = array();
      foreach($categorias as $categoria){
           $alldata[] = array(
                            'id' => $categoria->getId(),
                            'categoria' =>$categoria->getCategoria(),
                            'urlimg' => $categoria->getUrlimg());
      }
      $response = $response->withHeader('Content-Type', 'application/json');
      $response->write(json_encode($alldata));
      return $response;
}



public function listPizzaId(Request  $request, Response $response, $args)
{
    header('Access-Control-Allow-Origin: *'); 
    $manager = $this->em->getRepository('App\Model\Pizza')->findBy($array  = array('id' => $args['id']));
    //$pizza = $manager->findBy($array  = array('id' => $args['id']));
    $data = Array();
    foreach ($manager as $card) {
        
       $data[] = array(
                    'id' => $card->getId(),
                    'nome' =>$card->getNomesabor(),
                    'valorM' => $card->getValorM(),
                    'valorG' => $card->getValorG(),
                    'descricao' => $card->getDescrição(),
                    'urlimg' => $card->getUrlimg()
                );

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->write(json_encode($data));
        return $response;
   }
    

 
}

}
