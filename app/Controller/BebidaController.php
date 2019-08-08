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
    //Validar o nome da imagem se ja existe no banco de dado // validar o nome da pizza
    $produto =  $this->em->getRepository('App\Model\Produtos')->findAll();
        foreach ($produto as $value) {
           echo   "ID=" . $value->getId()."<br>";
           echo "Name=" .  $value->getName()."<br>";
           echo  "Quantidade=" .$value->getQtDade()."<br>";
           echo  "valorstoque=" .$value->getValorTotalStoque()."<br>";
           echo  "PrecoVenda=" . $value->getPrecoVenda()."<br>";
           echo  "PorcentagemVenda".$value->getPorcentagemVenda()."<br>";
           echo  "PrecoCompra" . $value->getPrecoCompra()."<br>";
           echo "---------------------------------". "</br>";

    

    }
      
    
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
    }
    

    //Gravar no Banco de dados o produto
   if(empty($_POST['name']))
   {
    $Produtos = new Produtos();
    $this->em->persist($Produtos);
    $Produtos->setName($_POST['name']);
    $Produtos->setDateValidade(new \DateTime($_POST['date']));
    $Produtos->setUrlImage($_FILES['url_image']['name']);
    $Produtos->setPorcentagemVenda($_POST['porcentagemVenda']);
    $Produtos->setPrecoCompra($_POST['preco_compra']);
    $Produtos->setDescricao($_POST['descricao']);
    $Produtos->setQtDade($_POST['qt_dade']);
    

    $preco_compra = floatval($_POST['preco_compra']);
    $porcentagemVenda= floatval($_POST['porcentagemVenda']);
    $Quantidade = floatval($_POST['qt_dade']);

    $resVAlorVenda = $preco_compra / 100 * ($porcentagemVenda) + ($preco_compra);

    $Produtos->setPrecoVenda($resVAlorVenda);

    $valorstoque = floatval($resVAlorVenda * $Quantidade);
    $Produtos->setValorTotalStoque($valorstoque);

    $this->em->flush();
}else{
  $this->flash->addMessageNow('msg', 'Campo obrigatorio');
            $messages = $this->flash->getMessages();

    return $this->container->view->render(
                            $response ,
                            'admin/form_bebida.twig',
                            Array( 
                              'messages' => $messages));  
}

    
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
