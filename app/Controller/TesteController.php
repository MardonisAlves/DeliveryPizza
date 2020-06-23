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
header('Access-Control-Allow-Origin: *'); // Este cabeçalho aceita qualquer requisição
$manager = $this->em->getRepository('\App\Model\Users');
$users = $manager->findBy($array = array('id' =>  $args['id']));
if($users){
  foreach ($users as $user) {
         // response json com withJsons
        $data =  $users = array(
        'id' => $user->getId(),
        'nome' => $user->getNome(),
        'email' => $user-> getEmail(),
        'tipouser' => $user->getTipouser());
        return $response->withJson($data , 200);
    }

}else{
  $data = $array = array('message' => 'Usuario não encontrado' );
  return $response->withJson($data , 404);
}
}


public function listall(Request  $request, Response $response, $args){
header('Access-Control-Allow-Origin: *'); // Este cabeçalho aceita qualquer requisição
$manager = $this->em->getRepository('\App\Model\Users')->findAll();


        foreach ($manager as $user) {
      /*  $data = array(
                      'Id' => $user->getId(),
                       'nome' => $user->getNome(),
                        'email' => $user-> getEmail(),
                        'tipouser' => $user->getTipouser()
                      );*/
      //  echo "Email" . $user->getEmail();


$var = json_encode($manager);

}

//  return $response->withJson($data , 200);   // response json com withJsons
}



// new User
public function user(Request $request , Response $response , $args)
{
    //get json
    header('Content-Type: application/json; charset=utf-8');
    $json = file_get_contents('php://input');
    $obj = json_decode($json);


    $user = new Users();
    $user->setEmail('donygp@gmail.com');
    $user->setNome('Dony Alves B');
    $user->setTipouser('client');
    $user->setSenha('qwe123qwe@');

    $this->em->persist($user);
    $this->em->flush();

  //  $data = $array = array('titulo' => 'update user' );
  //  return $response->withJson($data , 200);
}


// update User
public function updateuser(Request $request , Response $response , $args)
{
  $data = $array = array('titulo' => 'update user' );
  return $response->withJson($data , 200);
}


// delete user
public function deleteuser(Request $request , Response $response , $args)
{
  $data = $array = array('titulo' => 'delete user' );
  return $response->withJson($data , 200);
}

}
