<?php

namespace App\Controller;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Intervention\Image\ImageManager;
use App\Model\Users;
use App\Model\Pizza;
use App\Model\Produtos;
use Pusher\Pusher;

class RestControllerApi
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



public function listApiCardapio(Request  $request, Response $response, $args){
header('Access-Control-Allow-Origin: *'); // Este cabeçalho aceita qualquer requisição

$manager = $this->em->getRepository('\App\Model\Pizza')->findAll();

      $alldata = array();
      foreach($manager as $single){
           $alldata[] = array(
                            'id' => $single->getId(),
                            'nome' =>$single->getNomesabor(),
                            'valorM' => $single->getValorM(),
                            'valorG' => $single->getValorGs(),
                            'descricao' => $single->getDescrição());
      }

      //return $response->withJson($alldata, 200);

      $response = $response->withHeader('Content-Type', 'application/json');
      $response->write(json_encode($alldata));
      return $response;



}


}
