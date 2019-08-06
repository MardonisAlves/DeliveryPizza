<?php

namespace App\Controller;



use App\Validate\Validate;
use App\Model\Produtos;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\Constraint\Count;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Null_;
use \Psr\Http\Message\StreamInterface;
use Slim\Http\UploadedFile;




class BebidaController extends Validate
{
    protected $em;
    private $container;
    private $flash;
    
    
    public function __construct($container ,EntityManager $em ,$flash)
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;

        parent::__construct($container , $flash);

}



public function form_bebida(Request  $request, Response $response, $args)
{

    return $this->container->view->render($response, 'admin/form_bebida.twig');

}
//InsertBebidas
public function insert_bebidas(Request  $request, Response $response,  array $args)
{
    // Validar o nome da imagem se ja existe no banco de dado
    // validar o nome da pizza
   //var_dump($directory = $this->container->get('upload_directory'));

    $directory = $this->container->get('upload_directory');

   
    $uploadedFiles = $request->getUploadedFiles();

    // handle single input with single file upload
    $uploadedFile = $uploadedFiles['url_image'];

    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $filename = $this->moveUploadedFile($directory, $uploadedFile);
        $response->write('uploaded ' . $filename . '<br/>');
    }


    //Gravar no Banco de dados o produto

    
    $Produtos = new Produtos();
    $this->em->persist($Produtos);
    $Produtos->setName($_POST['name']);
    $Produtos->setDateValidade(new \DateTime($_POST['date']));
    $Produtos->setUrlImage($uploadedFile);
    $Produtos->setPorcentagemVenda($_POST['porcentagemVenda']);
    $Produtos->setPrecoCompra($_POST['preco_compra']);
    $Produtos->setDescricao($_POST['descricao']);

    $preco_compra = $_POST['preco_compra']/ 100;
    $mul_preco_compra = $preco_compra * $_POST['porcentagemVenda'];
    $soma  = $mul_preco_compra + $_POST['preco_compra'];

   var_dump($Produtos->setPrecoVenda($soma));

    $Produtos->setQtDade($_POST['setQtDade']);

    //$this->em->flush();

    
}
// Function para uploadsfile
public function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}




//GetIdBebidas
public function GetIdBebidas(Request  $request, Response $response, $args)
{
    print "getIdBebida";
}

//UpdateBebida
public function UpdateBebida(Request  $request, Response $response, $args)
{
    print "UpdateBebida";
}

}
