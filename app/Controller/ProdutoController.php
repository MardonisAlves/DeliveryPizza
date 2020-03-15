<?php

namespace App\Controller;



use App\Model\Produtos;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Slim\Http\UploadedFile;




class ProdutoController 
{
    protected $db;
    private $container;
    private $flash;
    private $session;
    
    
    public function __construct($container , $db ,$flash ,$session)
{
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;

}



public function form_bebida(Request  $request, Response $response, $args)
{
     if(($_SESSION['user']) == 'admin'){

    return $this->container->view->render($response, 'admin/produtos/produtos.twig');
    
    }

   

    $url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location', $url);

}
//InsertBebidas
public function insertBebidas(Request  $request, Response $response,  array $args)
{
    if(($_SESSION['user']) == 'admin'){
    //Validar o nome da imagem se ja existe no banco de dado // validar o nome da pizza
    $produto = $this->db->query("SELECT * FROM Produtos");


    while ($pro = $produto->fetch()) 
    {
        if($pro['nome'] == $_POST['nome'])
        {
            $this->flash->addMessageNow('msg', 'Este nome Ja Existe');
            $messages = $this->flash->getMessages();

    return $this->container->view->render(
                            $response ,
                            'admin/produtos/form_bebida.twig',
                            Array( 
                              'messages' => $messages));
        }
    }

   

    //Gravar no Banco de dados o produto
    $produtos = new Produtos();
    $produtos->setConnection($this->db);
    $produtos->setContainer($this->container);
    $produtos->setSession($this->session);
    $produtos->setId(0);
    $produtos->setNome($_POST['nome']);
    $produtos->setQtdade($_POST['qt_dade']);
    $produtos->setDatavalidade($_POST['date']);
    $produtos->setPrecocompra($_POST['precocompra']);
    $produtos->setPorcentagemvenda($_POST['porcentagemVenda']);
    $produtos->setDesccricao($_POST['descricao']);
    $produtos->insertProdutos();
    
                                               
    // Redirect para listar

    $url = $this->container->get('router')->pathFor('produtos');
    return $response->withStatus(302)->withHeader('Location', $url);

}

$url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location', $url);
}
// Form listar
public function listar_produto(Request  $request, Response $response, $args)
{
    if(($_SESSION['user']) == 'admin'){
    $pro = new Produtos();
    $pro->setConnection($this->db);
    $pro->setContainer($this->container);
    $pro->setSession($this->session);
    $pro->listarProdutos();

    return $this->container->view
    ->render($response ,'admin/produtos/listar_produto.twig' , 
        ['produto'=>$pro->listarProdutos()]);

}



    $url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location', $url);
}
//GetIdBebidas
public function updateProdutos(Request  $request, Response $response, $args)
{
    if(($_SESSION['user']) == 'admin'){
    $Stoque = new Produtos();
    $Stoque->setConnection($this->db);
    $Stoque->setContainer($this->container);
    $Stoque->setSession($this->session);
    $Stoque->setId($_POST['id']);
    $Stoque->setQtdade($_POST['qt']);
    $Stoque->setPorcentagemvenda($_POST['porcentagemvenda']);
    $Stoque->setPrecocompra($_POST['precocompra']);
    $Stoque->updateProduto();


    $url = $this->container->get('router')->pathFor('produtos');
    return $response->withStatus(302)->withHeader('Location', $url);
    
}

$url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location', $url);
}
public function deletaProduto(Request  $request, Response $response, $args)
{
    if(($_SESSION['user']) == 'admin'){
    $produto = new Produtos();
    $produto->setConnection($this->db);
    $produto->setId($_GET['id']);
    $produto->deleteProduto();

    $url = $this->container->get('router')->pathFor('produtos');
    return $response->withStatus(302)->withHeader('Location', $url);

}
$url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location', $url);
}
    
}