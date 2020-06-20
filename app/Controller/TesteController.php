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

class TesteController
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


public function list(Request  $request, Response $response, $args){
//  $ARGS['id']   nesta variavel passamos o terceito argumento para consulta
// $this->get('/list/{id}' , 'TesteController:list')->setName('list');

$manager = $this->em->getRepository('\App\Model\Users');
$users = $manager->findBy($array = array('id' =>  $args['id']));

        foreach ($users as $user) {
        $data =  $users = array(
                          'email' => $user->getEmail(),
                          'Id' => $user->getId(),
                          'nome' => $user-> getNome()
                        );
        return $response->withJson($data , 200);   // response json com withJsons
}

// new User
public function newuser(Request $request , Response $response , $args)
{

}

}
}
