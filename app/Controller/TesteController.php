<?php

namespace App\Controller;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\Users;

class TesteController
{
    protected $db;
    private $container;
    private $flash;
    private $session;
    
    public function __construct($container , $db ,$flash ,  $session )
{
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;     
}

/*=================================================================
 *================== METHODS FOR TEST==============================*/

public function Teste(Request  $request, Response $response, $args)
{

    $Users = new Users();
    $Users->setConnection($this->db);
    $Users->selctUsers();

}

public function  Teste_insert(Request  $request, Response $response, $args)
{
     

    // user

    $senha = (password_hash("jk8yup02@",PASSWORD_DEFAULT));
    $id=0;
    $nome = "Mardonis Alves B";
    $email = "mardonisgp@gmail.com";
    $tipo = "admin";

    $sql = "INSERT INTO Users(id,email, nome , senha , tipouser) VALUES(:id ,:email, :nome, :senha , :tipouser)";

    $stmt = $this->db->prepare( $sql );
    $stmt->bindParam( ':id', $id);
    $stmt->bindParam( ':email', $email);
    $stmt->bindParam( ':nome', $nome );
    $stmt->bindParam( ':senha', $senha );
    $stmt->bindParam( ':tipouser', $tipo );

    $result = $stmt->execute();
        
    }
}
