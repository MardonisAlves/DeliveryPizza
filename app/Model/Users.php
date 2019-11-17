<?php

namespace App\Model;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Users
{
    private $id;
    private $email;
    private $nome;
    private $senha;
    private $tipouser;
    private $Connection;
    private $container;
    private $session;
    private $flash;



    public function getId()
    {
        return $this->id;
    }

   
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
  
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }
    
    public function setSenha($senha)
    {
        $this->senha = (password_hash($senha,PASSWORD_DEFAULT));

        return $this;
    }

  
    public function getTipouser()
    {
        return $this->tipouser;
    }

    public function setTipouser($tipouser)
    {
        $this->tipouser = $tipouser;

        return $this;
    }

    
    public function getConnection()
    {
        return $this->Connection;
    }


    public function setConnection($Connection)
    {
        $this->Connection = $Connection;

        return $this;
    }

      // GET Container 
      public function getContainer()
      {
          return $this->container;
      }
  
    
      public function setContainer($container)
      {
          $this->container = $container;
  
          return $this;
      }


      // session
      public function getSession()
    {
        return $this->session;
    }

  
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }
    // flash
    public function getFlash()
    {
        return $this->flash;
    }
    
    public function setFlash($flash)
    {
        $this->flash = $flash;

        return $this;
    }
    // iinsert user
    public function insert($response){

    $sql = "INSERT INTO Users(id,email, nome , senha , tipouser) VALUES(:id ,:email, :nome, :senha , :tipouser)";

    $stmt = $this->getConnection()  ->prepare( $sql );
    $stmt->bindParam( ':id', $this->getId());
    $stmt->bindParam( ':email', $this->getEmail());
    $stmt->bindParam( ':nome', $this->getNome() );
    $stmt->bindParam( ':senha', $this->getSenha());
    $stmt->bindParam( ':tipouser', $this->getTipouser());

    $result = $stmt->execute();

    }

    // get All Users
    public function selctUsers($response)
    {
        
        $users = $this->getConnection()->query("SELECT * FROM Users" ,PDO::FETCH_ASSOC);
        
        return $this->getContainer()->view->render($response ,'admin/users/listarUser.twig', ["users"=>$users]);
       
    }

    // update users

    public function updateusers($response){


        $user =  "UPDATE Users set email=:email ,tipouser=:tipouser where id=:id";
        $stmt = $this->getConnection()->prepare($user);

        $stmt->bindParam("id" , $this->getId());
        $stmt->bindParam("email" , $this->getEmail());
        $stmt->bindParam("tipouser" , $this->getTipouser());
        $stmt->execute();

    }

    // delete user
    public function deleteuser($response){

        $users =  "DELETE from Users where id=:id";
        $stmt= $this->getConnection()->prepare($users);
        $stmt->bindParam("id" , $this->getId());
        $stmt->execute();
          
    }

    }
