<?php

namespace App\Controller;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Intervention\Image\ImageManager;
use App\Model\Users;
use App\Model\ModelUsers;
use App\Model\Pizza;
use App\Model\Produtos;
use Pusher\Pusher;
use PDO;
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
    $pizza = new Pizza();
    $pizza->setConnection($this->db);
    $pizza->setContainer($this->container);
    $listaIdcadapio =  $pizza->selectByid( $_GET['q']);

    foreach ($listaIdcadapio as $key => $value) {
       echo  $value['id'];
       echo $value['nomesabor'];
}


}

public function listprodutos(Request  $request, Response $response, $args){

        $Produtos = new Produtos();
        $Produtos->setConnection($this->db);
        $Produtos->setContainer($this->container);
        $viewpro = $Produtos->listarProdutos();

       foreach ($viewpro as $key => $value) {
       echo  $value['id'];
        $_SESSION['idtest'] = $value['id'];
       }
       
        $jason = json_encode($viewpro);

        return $this->container
                    ->view->render($response,
                    'admin/home.twig' ,
                    ['viewpro' => $jason]);

}

public function socketio(Request  $request, Response $response, $args){

    echo "socketio";

    $options = array(
    'cluster' => 'mt1',
    'useTLS' => false
  );
  $pusher = new Pusher(
    '31c79ef0bedc8601377b',
    '052380beaa5108c68647',
    '972105',
    $options
  );
 
  $data['message'] =  $_SESSION['nome'] .  "Acabou de Finalizar Um Pedido";
  $pusher->trigger('my-channel', 'my-event', $data);

}

public function list(Request  $request, Response $response, $args){

$productRepository = $this->em->getRepository("App/Model/ModelUsers");
$users = $productRepository->findAll();

foreach ($users as $user) {
    echo sprintf("-%s\n", $product->getNome());
}
  

}
}
