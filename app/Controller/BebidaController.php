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
    // Validar o nome da imagem se ja existe no banco de dado // validar o nome da pizza
    $produto =  $this->em->getRepository('App\Model\Produtos')->findAll();
        foreach ($produto as $value) {
           echo   "ID=" . $value->getId()."<br>";
           echo "Name=" .  $value->getName()."<br>";
           echo  "Quantidade=" .$value->getQtDade()."<br>";
           echo  "valorstoque=" .$value->getValorTotalStoque()."<br>";
           echo  "PrecoVenda=" . $value->getPrecoVenda()."<br>";
           echo  "PorcentagemVenda".$value->getPorcentagemVenda()."<br>";
           echo  "PrecoCompra" . $value->getPrecoCompra()."<br>";
           echo "---------------------------------";
        }



      
    /*
    foreach ($produto as  $value) {
        if($value->getUrlImage() == $_FILES['url_image']['name'])
        {
            $this->flash->addMessageNow('msg', 'Escolha outro nome para imagem');
            $messages = $this->flash->getMessages();

    return $this->container->view->render(
                            $response ,
                            'admin/form_bebida.twig',
                            Array( 
                              'messages' => $messages));
        }else{

        $directory = $this->container->get('upload_directory');
        $destination  = $directory . $_FILES['url_image']['name'];
        $move = move_uploaded_file($_FILES['url_image']['tmp_name'], $destination);

        }
    }*/
    

    //Gravar no Banco de dados o produto
   
    $Produtos = new Produtos();
    $this->em->persist($Produtos);
    $Produtos->setName($_POST['name']);
    $Produtos->setDateValidade(new \DateTime($_POST['date']));
    $Produtos->setUrlImage($_FILES['url_image']['name']);
    $Produtos->setPorcentagemVenda($_POST['porcentagemVenda']);
    $Produtos->setPrecoCompra($_POST['preco_compra']);
    $Produtos->setDescricao($_POST['descricao']);

    $a = floatval($_POST['preco_compra']);
    $preco_compra = $a / 100;

    $mul_preco_compra = floatval($preco_compra) * ($_POST['porcentagemVenda']);

    $soma  = $mul_preco_compra + $_POST['preco_compra'];
    floatval($soma);
    $Produtos->setPrecoVenda($soma);

    $Produtos->setQtDade($_POST['qt_dade']) * $a;

    $valorstoque = floatval($_POST['qt_dade'] * $soma);
    

    number_format($Produtos->setValorTotalStoque($valorstoque),"2",'.', ',');

    $this->em->flush();

    
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
