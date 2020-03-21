<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\Cardapio;
use App\Helper\HelperSize;

class CardapioController 
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

    // verificar se o cardapio ja exiti

    // insert cardapio
    /*
    $cardapio =  new Cardapio();
    $cardapio->setConnection($this->db);
    $cardapio->setContainer($this->container);
    $cardapio->setSession($this->session);
    $cardapio->setId(0);
    $cardapio->setNomesabor($_POST['nomesabor']);
    $cardapio->setTamanho($_POST['tamanho']);
    $cardapio->setValor($_POST['valor']);
    $cardapio->setDescricao($_POST['descricao']);
    

 // fazer upload da img do cardapio criar um method para issso
        $directory = $this->container->get('upload_directory');
        $destination  = $directory . $_FILES['urlimg']['name'];
        $move = move_uploaded_file($_FILES['urlimg']['tmp_name'], $destination);

    $cardapio->setUrlimg($destination);
    $cardapio->insert();

        // depois render para view
    $url = $this->container->get('router')->pathFor('listar');
    return $response->withStatus(302)->withHeader('Location' ,$url);
*/

    
    
$file = $_FILES['urlimg']['tmp_name']; 
        $sourceProperties = getimagesize($file);
        $fileNewName = time();
       
        $directory = $this->container->get('upload_directory');
        $folderPath  = $directory . $_FILES['urlimg']['name'];
        $ext = pathinfo($_FILES['urlimg']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];

         switch ($imageType) {


            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagepng($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                break;


            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagegif($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                break;


            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file); 
                $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
                break;


            default:
                echo "Invalid Image type.";
                exit;
                break;
        }

        move_uploaded_file($file, $folderPath);

        echo "Image Resize Successfully.";

    $cardapio =  new Cardapio();
    $cardapio->setConnection($this->db);
    $cardapio->setContainer($this->container);
    $cardapio->setSession($this->session);
    $cardapio->setId(0);
    $cardapio->setNomesabor($_POST['nomesabor']);
    $cardapio->setTamanho($_POST['tamanho']);
    $cardapio->setValor($_POST['valor']);
    $cardapio->setDescricao($_POST['descricao']);
    $cardapio->setUrlimg($folderPath. $fileNewName. "_thump.". $ext);
    $cardapio->insert();


     $url = $this->container->get('router')->pathFor('listar');
    return $response->withStatus(302)->withHeader('Location' ,$url);
}


}

// resize 

public function imageResize($imageResourceId,$width,$height) {


    $targetWidth =200;
    $targetHeight =200;


    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);


    return $targetLayer;
}


// listar\
public function listarcardapio( $request,  $response, $args)
{
    if(($_SESSION['user']) == 'admin'){
                $cardapio = new Cardapio();
                $cardapio->setConnection($this->db);
                $cardapio->setContainer($this->container);
                $cardapio->selctAll($response);
                
                return $this->container->view->render($response ,"admin/cardapio/listarcardapio.twig" ,
                                                                ['card' => $cardapio->selctAll($response)]);
                
             
}

    $url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location' ,$url);

}
// atualizar
public function updatePizza(Request $request, Response $response, $args)
{
    if(($_SESSION['user']) == 'admin'){
    $Card = new Cardapio();
    $Card->setConnection($this->db);
    $Card->setId($_POST['id']);
    $Card->setValor($_POST['valor']);
    $Card->updatePizza();

    $url = $this->container->get('router')->pathFor('listar');
    return $response->withStatus(302)->withHeader('Location' ,$url);

}
}

// excluir
public function excluircardapio(Request $request, Response $response, $args)
{
     if(($_SESSION['user']) == 'admin'){
    //echo "Excluir Cardapio e renderizar para view admin";
    $card = new Cardapio();
    $card->setConnection($this->db);
    $card->setId($_GET['id']);
    $card->excluircardapio();

    $url = $this->container->get('router')->pathFor('listar');
    return $response->withStatus(302)->withHeader('Location' ,$url);

}
}
}