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
                $imageResourceId = imagecreatefrompng($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
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
                imagejpeg($targetLayer ,$folderPath . $fileNewName. "_thump.". $ext );
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
    move_uploaded_file($fileNewName. "_thump.". $ext);
    }        

       
    $pizza =  new Pizza();
    $pizza->setConnection($this->db);
    $pizza->setId(0);
    $pizza->setNomesabor($_POST['nomesabor']);
    $pizza->setCategoria($_POST['categoria']);
    $pizza->setValorM($_POST['valorM']);
    $pizza->setValorG($_POST['valorG']);
    $pizza->setDescricao($_POST['descricao']);
    $cardapizzapio->setUrlimg($folderPath . $fileNewName. "_thump.". $ext);
    $pizza->insert();

       

   $this->flash->addMessageNow('msg', 'Pizza cadastrado com sucesso!');
  				$messages = $this->flash->getMessages();
            	return $this->container
            				->view->render($response ,
            				'admin/cardapio/cardapio.twig' , ['messages' => $messages]);
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
    if(($_SESSION['user']) == 'admin'){
                $pizza = new Pizza();
                $pizza->setConnection($this->db);
                $pizza->setContainer($this->container);
                $pizza->selctAll($response);
                
                return $this->container->view->render($response ,
                "admin/cardapio/listarcardapio.twig" ,
                 ['card' => $pizza->selctAll($response)]);
                
             
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
                $pizza->selectByid($_GET['id']);
                
                return $this->container
                            ->view
                            ->render($response ,
                                "admin/cardapio/pizza.twig" ,
                            ['cardapio' => $pizza->selectByid($_GET['id'])]);

    }

     $url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location' ,$url);
}




// atualizar
public function updatepizzaPizza(Request $request, Response $response, $args)
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
    $pizza->setUrlimg($_GET['urlimg']);
    $pizza->excluirpizza();

    
    // deletar img
    $directory = $this->container->get('upload_directory');
    unlink($directory . $_GET['urlimg']);
    
     


    $url = $this->container->get('router')->pathFor('listar');
    return $response->withStatus(302)->withHeader('Location' ,$url);
    
   
}
}
}