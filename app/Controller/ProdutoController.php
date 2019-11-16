<?php

namespace App\Controller;



use App\Model\Produtos;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\StreamInterface;
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

    return $this->container->view->render($response, 'admin/produtos/form_bebida.twig');

}
//InsertBebidas
public function insert_bebidas(Request  $request, Response $response,  array $args)
{
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

    /*foreach ($produto as  $value) {
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
    $id=0;
    $newproduto = "INSERT INTO Produtos(id , nome, descricao ,
                                            preco_compra, porcentagem_venda,
                                            preco_venda, valor_total_stoque,
                                            qt_dade, date_validade)
                                            VALUES(
                                                :id , :nome, 
                                                :descricao ,
                                                :preco_compra,
                                                :porcentagem_venda,
                                                :preco_venda,
                                                :valor_total_stoque,
                                                :qt_dade,
                                                :date_validade)";
    $stmt = $this->db->prepare($newproduto);
    $stmt->bindParam("id" , $id);
    $stmt->bindParam("nome" , $_POST['nome']);
    $stmt->bindParam("descricao" , $_POST['descricao']);
    $stmt->bindParam("preco_compra" , $_POST['preco_compra']);
    $stmt->bindParam("porcentagem_venda" , $_POST['porcentagemVenda']);

    $preco_compra = floatval($_POST['preco_compra']);
    $porcentagemVenda= floatval($_POST['porcentagemVenda']);
    $Quantidade = floatval($_POST['qt_dade']);
    $resVAlorVenda = $preco_compra / 100 * ($porcentagemVenda) + ($preco_compra);

    $stmt->bindParam("preco_venda" , $resVAlorVenda);

    $valorstoque = floatval($resVAlorVenda * $Quantidade);

    $stmt->bindParam("valor_total_stoque" , $valorstoque);
    $stmt->bindParam("qt_dade" , $_POST['qt_dade']);
    $stmt->bindParam("date_validade" , $_POST['date']);
    $stmt->execute();
    
                                               
    // Redirect para listar

    $url = $this->container->get('router')->pathFor('produtos');
    return $response->withStatus(302)->withHeader('Location', $url);

}
// Form listar
public function listar_produto(Request  $request, Response $response, $args)
{
    $produto =  $this->db->query("SELECT * FROM Produtos");
    return $this->container->view
                            ->render($response ,'admin/produtos/listar_produto.twig' , 
                                ['produto'=>$produto]);
}
//GetIdBebidas
public function updateProduto(Request  $request, Response $response, $args)
{
      // Agora vamos update produtos
      // calcular o valor de estoque
      // calcular preço de venda
    $produto = "UPDATE Produtos set qt_dade=:qt_dade,
                                    porcentagem_venda=:porcentagem_venda ,
                                    preco_compra=:preco_compra where id=:id";
    $stmt = $this->db->prepare($produto);
    $stmt->bindParam("id" , $_POST['id']);
    $stmt->bindParam("qt_dade" , $_POST['qt']);
    $stmt->bindParam("preco_compra" , $_POST['preco_compra']);
    $stmt->bindParam("porcentagem_venda" , $_POST['porcentagem_venda']);
    $stmt->execute();
    
     return $response
     ->withHeader('Location', '/produtos')
     ->withStatus(302);

}

}
