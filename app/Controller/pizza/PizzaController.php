<?php

namespace App\Controller\pizza;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\Pizza;
use App\Model\Categorias;
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
    $categorias = $this->db->getRepository('App\Model\Categorias')->findAll();
    return $this->container->view->render($response ,'admin/cardapio/cardapio.twig' ,['categorias' => $categorias]);
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
                $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagepng($targetLayer,$folderPath);
                break;


            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file);
                $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagegif($targetLayer,$folderPath);
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
    move_uploaded_file($folderPath ,  $_FILES['urlimg']['name']);
    
    $cate = $this->db->find('App\Model\Categorias', $_POST['categoria_id']);

    $pizza = new Pizza();
    $pizza->setNomesabor($_POST['nomesabor']);
    $pizza->setCategorias($cate);
    $pizza->setValorM($_POST['valorM']);
    $pizza->setValorG($_POST['valorG']);
    $pizza->setDescrição($_POST['descricao']);
    $pizza->setUrlimg($_FILES['urlimg']['name']);
    $this->db->persist($pizza);
    $this->db->flush();

    $url = $this->container->get('router')->pathFor('viewlistar');
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


// listar
public function viewlistar( $request,  $response, $args)
{
    $categorias = $this->db->getRepository('App\Model\Categorias')->findAll();
 

    return $this->container->view->render($response , 
    "admin/categoria/listarcategoria.twig" ,['categorias' => $categorias]);

}

// all pizza
public function allpiza(Request $req, Response $res, $args)
{
$categorias = $this->db->find('App\Model\Categorias' , $args['id']);  
$pizzas = $this->db->getRepository('App\Model\Pizza')->findBy(array('categorias' => $categorias->getId()));
return $this->container->view->render($res , 
"admin/cardapio/listarcardapio.twig" ,['pizzas' => $pizzas ]);
}

// listar by id
public function listarByid($request,  $response, $args)
{

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
    //$cate = $this->db->find('App\Model\Categorias' , $args['id']);
   
    $pizzaid = $this->db->find('App\Model\Categorias' , $args['id']);
    $pizza = $this->db->find('App\Model\Pizza' , $pizzaid);
    $this->db->remove($pizza);
    $this->db->flush();

    $directory = $this->container->get('upload_directory');
    unlink($directory . $pizza->getUrlimg());

    echo "<p class='red text-darken-1'>Item excluido com sucesso</p>";





}

}
