<?php

namespace App\Controller\categoria;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\Categorias;
use App\Helper\HelperSize;

class CategoriaController
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
public  function categoria(Request $request, Response $response, $args)
{
    return $this->container->view->render($response ,'admin/cardapio/categoria.twig');
}
// inserir
public function newcategoria( $request,  $response, $args)
{
  if(($_SESSION['user']) == 'admin'){
        $file = $_FILES['urlimg']['tmp_name'];
        $sourceProperties = getimagesize($file);
        $fileNewName = time();

        $directory = $this->container->get('upload_directory_categoria');
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
    

    $categoria = new Categorias();
    $categoria->setCategoria($_POST['categoria']);
    $categoria->setUrlimg($_FILES['urlimg']['name']);

    $this->db->persist($categoria);
    $this->db->flush();

    
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
public function listacategoria( $request,  $response, $args)
{
 
}






// atualizar
public function updatecategoria(Request $request, Response $response, $args)
{
   

}


// excluir
public function excluir(Request $request, Response $response, $args)
{
   $categoria = $this->db->find('App\Model\Categorias' ,7);
    $this->db->remove($categoria);
    $this->db->flush();
    $directory = $this->container->get('upload_directory_categoria');
    unlink($directory . $categoria->getUrlimg());

    echo "<p class='red text-darken-1'>Item excluido com sucesso</p>";
   

}



}


