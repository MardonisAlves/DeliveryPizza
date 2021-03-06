<?php

namespace App\Controller\teste;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Intervention\Image\ImageManager;
use App\Model\Users;
use App\Model\Pizza;
use App\Model\Categorias;
use App\Model\Produtos;
use Pusher\Pusher;
use Doctrine\Common\Collections\ArrayCollection;

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

      $alldata = array();
      foreach($manager as $single){
           $alldata[] = array(
                            'id' => $single->getId(),
                            'nome' =>$single->getNome(),
                            'email' => $single->getEmail(),
                            'tipouser' => $single->getTipouser());
      }

      //return $response->withJson($alldata, 200);

      $response = $response->withHeader('Content-Type', 'application/json');
      $response->write(json_encode($alldata));
      return $response;



}



// new User
public function user(Request $request , Response $response , $args)
{

    header("Access-Control-Allow-Origin: *");
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    
    $user = new Users();
    $user->setEmail($obj->email);
    $user->setNome($obj->name);
    $user->setTipouser($obj->typeuser);
    $user->setSenha($obj->password);

    $this->em->persist($user);
    $this->em->flush();

 $array = array('data' => $obj );
    return $response->withJson($array , 200);
  
}


// update User
public function updateuser(Request $request , Response $response , $args)
{

  $data = $array = array('id' => $args );
  return $response->withJson($data , 200);
}


// delete user
public function deleteuser(Request $request , Response $response , $args)
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');

    $manager = $this->em->getRepository('App\Model\Users')->findBy(array('id' => $args['id']));
    foreach ($manager as  $user) {
      $this->em->remove($user);
    }

    $this->em->flush();

}

// ============TesteCardapio=================================

public function newtesteCar(Request $request , Response $response , $args){

  
    $cate = $this->em->find('App\Model\Categorias', 11);

    //var_dump($cate->getId());
    //$categoria = new Categorias();
    //$categoria->setCategoria('teste9');
    //$categoria->setUrlimg('teste9');

    $pizza = new Pizza();
    $pizza->setNomesabor('TesteSabor');
    $pizza->setCategorias($cate);
    $pizza->setValorM('valorM');
    $pizza->setValorG('valorG');
    $pizza->setDescrição('descricao');
    $pizza->setUrlimg('urlimg');

    //$this->em->persist($cate);
    $this->em->persist($pizza);
    $this->em->flush();
}

// delete pizza by id
public function deleteByid(Request $req , Response $res , $args)
{
      //$pizzaid = $this->em->find('App\Model\Categorias' , $args['id']);

    $categorias = $this->em->find('App\Model\Categorias' , $args['id']);
    

    foreach ($categorias->getPizza() as $key => $value) {
      echo $value->getValorM()."<br>";
      echo  $value->getId()."<br>";

      if($value->getId() == 113){ // a varialvel get com id pizza
      
       $pizza = $this->em->find('App\Model\Pizza', 113);
       $this->em->remove($pizza);
       $this->em->flush();

    }
  }


   // $directory = $this->container->get('upload_directory');
   // unlink($directory . $pizza->getUrlimg());

    //echo "<p class='red text-darken-1'>Item excluido com sucesso</p>";


}

}
