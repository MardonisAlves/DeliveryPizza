<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\Pizza;
use App\Helper\HelperSize;

class PizzaController
{
    protected $db;
    private $container;
    private $flash;
    private $session;

    public function __construct($container , $db ,$flash ,  $session)
{
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;


}
// index cardapio get form
public  function index(Request $request, Response $response, $args)
{
    return $this->container->view->render($response ,'admin/cardapio/cardapio.twig');
}
// inserir
public function inserircardapio( $request,  $response, $args)
{

     if(($_SESSION['user']) == 'admin'){



$file = $_FILES['urlimg']['tmp_name'];
        $sourceProperties = getimagesize($file);
        $fileNewName = time();

        $directory = $this->container->get('upload_directory');
        $folderPath  = $directory . $_FILES['urlimg']['name'];
        $ext = pathinfo($_FILES['urlimg']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];

         switch ($imageType) {


            case IMAGETYPE_PNG:
                $imageResourceId = @imagecreatefrompng($file);
                $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagepng($targetLayer,$folderPath . $fileNewName. "_thump.". $ext);
                break;


            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file);
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagegif($targetLayer,$folderPath . $fileNewName. "_thump.". $ext);
                break;


            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file);
                $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($targetLayer ,$folderPath );
                break;


            default:
            	$this->flash->addMessageNow('msg', 'Por favor escolhar uma imagem PNG ,GIF ou JPEG');
  				$messages = $this->flash->getMessages();
            	return $this->container
            				->view->render($response ,
            				'admin/cardapio/cardapio.twig' , ['messages' => $messages]);

                exit;
                break;
        }

    if(isset($_POST['submit'])){
    move_uploaded_file($folderPath ,  $_FILES['urlimg']['name']);
    }
    if($_POST['categoria'] == "pizzas"){
    $pizza = new Pizza();
    $pizza->setNomesabor($_POST['nomesabor']);
    $pizza->setCategoria($_POST['categoria']);
    $pizza->setValorM($_POST['valorM']);
    $pizza->setValorG($_POST['valorG']);
    $pizza->setDescrição($_POST['descricao']);
    $pizza->setUrlimg($_POST['urlimg']);

    $this->db->persist($pizza);
    $this->db->flush();
    }else{
    $pizza->insertDefault();

  }
    $url = $this->container->get('router')->pathFor('listar');
    return $response->withStatus(302)->withHeader('Location' ,$url);
}
}


// resize
public function imageResize($imageResourceId,$width,$height) {


    $targetWidth =450;
    $targetHeight =450;


    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);


    return $targetLayer;
}


// listar\
public function listarcardapio( $request,  $response, $args)
{
  // RETONAR UMA LISTA POR CATEGORIA VIA AJAX
    if(($_SESSION['user']) == 'admin'){

$card = $this->db->getRepository('App\Model\Pizza')->findAll();

if($_GET['categoria'] == 'pizzas'){
echo "<div class='col s12 m10 l6'>
<table id='example' class='mdl-data-table  striped'>

    <thead>
      <tr>
        <th scope='col'>Sabor</th>
        <th scope='col'>Media</th>
        <th scope='col'>Grande</th>
        <th scope='col'>Descrição</th>
        <th scope='col'>Action</th>

      </tr>
    </thead>
<tbody>";
}else{
  echo "<div class='col s12 m10 l6'>
<table id='example' class='mdl-data-table  striped'>

    <thead>
      <tr>
        <th scope='col'>Sabor</th>
        <th scope='col'>Valor</th>
        <th scope='col'>Descrição</th>
        <th scope='col'>Action</th>

      </tr>
    </thead>
<tbody>";
}

foreach ($card as $key => $value)
{

if($value['categoria'] == 'pizzas'){
 echo "<tr>
    <td>$value->getNomesabor()</td>
    <td>$value->getValorM()</td>
    <td>$value->getValorG()</td>
    <td>$value->getDescricao()</td>
    <td>
    <a href='#' class='waves-effect waves-light green-text darken-4 large' onclick = 'Pizza($value[id])'>
    <i class='material-icons left'>edit_attributes</i>
    </a>
    <a href='#'  class='waves-effect waves-light  orange-text darken-4' onclick='Deletar($value[urlimg])'>
    <i class='material-icons orange-text darken-4 left'>restore_from_trash</i>
    </a>
    </td>
  </tr>";

}else{
   echo "<tr>
    <td>$value->getNomesabor()</td>
    <td>$value->getValor()</td>
    <td>$value->getDescricao()</td>
    <td>
    <a href='#' class='waves-effect waves-light green-text darken-4 large' onclick = 'Pizza($value[id])'>
    <i class='material-icons left'>edit_attributes</i>
    </a>
    <a href='#'  class='waves-effect waves-light  orange-text darken-4' onclick = 'Deletar($value[urlimg])'>
    <i class='material-icons orange-text darken-4 left'>restore_from_trash</i>
    </a>
    </td>
  </tr>";
}
}

}
}


    //$url = $this->container->get('router')->pathFor('home');
    //return $response->withStatus(302)->withHeader('Location' ,$url);



public function viewlistar( $request,  $response, $args)
{
  // RETONAR UMA LISTA POR CATEGORIA VIA AJAX
    if(($_SESSION['user']) == 'admin'){
    $card = $this->db->getRepository('App\Model\Pizza')->findAll();
    return $this->container->view->render($response , "admin/cardapio/listarcardapio.twig" ,['card' => $card]);
}
    $url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location' ,$url);
}


// listar by id
public function listarByid($request,  $response, $args)
{
    if(($_SESSION['user']) == 'admin'){
                $pizza = new Pizza();
                $pizza->setConnection($this->db);
                $pizza->setContainer($this->container);
               $pizzaid =  $pizza->selectByid($_GET['id']);

foreach ($pizzaid as $key => $value) {
    if($value['categoria'] == "pizzas"){
echo "<div class='row'>
        <br>
    <form class='col s12 m12 l6' action='/atualizar' method='post' enctype='multipart/form-data'>

      <div class='row'>
        <div class='input-field col s12 m12 l12'>
         Nome: <input  type='text' class='validate'  value='$value[nomesabor]'>
        </div>
        </div>

        <div class='row'>
        <div class='input-field col s6 m12 l6'>
        Valor M:<input  type='text' class='validate' name='valorM' value='$value[valorM]'>
        </div>
         <div class='input-field col s6 m12 l6'>
        Valor G:<input  type='text' class='validate' name='valorG' value='$value[valorG]'>
        </div>
      </div>

       <div class='row'>
         <div class='input-field col s12 m12 l12'>
         Descrição: <textarea id='textarea' class='materialize-textarea' name='descricao' required=''>$value[descricao]</textarea>
        </div>
      </div>


      <div class='row'>
       <div class='input-field col s12'>
         <button class='btn waves-effect waves-light btn-small' type='submit' name='action'>
            <i class='material-icons right'>send</i>
        </button>
       </div>
      </div>
    </form>
  </div>";
}else{

    echo "<div class='row'>
        <br>
    <form class='col s12 m12 l6' action='/atualizar' method='post' enctype='multipart/form-data'>

      <div class='row'>
        <div class='input-field col s12 m12 l12'>
         Nome: <input  type='text' class='validate'  value='$value[nomesabor]'>
        </div>
        </div>

        <div class='row'>
        <div class='input-field col s6 m12 l12'>
        Valor :<input  type='text' class='validate' name='valor' value='$value[valor]'>
        </div>
      </div>

       <div class='row'>
         <div class='input-field col s12 m12 l12'>
         Descrição: <textarea id='textarea' class='materialize-textarea' name='descricao' required=''>$value[descricao]</textarea>
        </div>
      </div>


      <div class='row'>
       <div class='input-field col s12'>
         <button class='btn waves-effect waves-light btn-small' type='submit' name='action'>
            <i class='material-icons right'>send</i>
        </button>
       </div>
      </div>
    </form>
  </div>";
}
                }

               /* return $this->container
                            ->view
                            ->render($response ,
                                "admin/cardapio/pizza.twig" ,
                            ['cardapio' => $pizza->selectByid($_GET['id'])]);*/

    }

        //$url = $this->container->get('router')->pathFor('home');
        //return $response->withStatus(302)->withHeader('Location' ,$url);
}




// atualizar
public function updatePizza(Request $request, Response $response, $args)
{
    if(($_SESSION['user']) == 'admin'){
    $pizza = new Pizza();
    $pizza->setConnection($this->db);
    $pizza->setId($_POST['id']);
    $pizza->setValor($_POST['valor']);
    $pizza->updatePizza();

    $url = $this->container->get('router')->pathFor('listar');
    return $response->withStatus(302)->withHeader('Location' ,$url);

}
}

// excluir
public function excluirpizza(Request $request, Response $response, $args)
{

    if(($_SESSION['user']) == 'admin'){

    //echo "Excluir Pizza e renderizar para view admin";


    $pizza = new Pizza();
    $pizza->setConnection($this->db);
    $pizza->setId($_GET['urlimg']);
    $pizza->excluirpizza();


    $directory = $this->container->get('upload_directory');
    unlink($directory . $_GET['urlimg']);

    echo "<p class='red text-darken-1'>Item excluido com sucesso</p>";

}



}

}
