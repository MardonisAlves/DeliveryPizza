<?php

namespace App\Model;
use App\AbstractModel\BaseAbstract;
use App\interfaces\interfaceUser;
use App\Model\Users;
use PDO;

class Contact extends Users
{

  private $id;
  private $email;
  private $nome;
  private $telefone;
  private $message;

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

  
  public function setTelefone($telefone){
    $this->telefone = $telefone;
    return $this;
  }

  public function getTelefone(){
   
    return $this->telefone;
  }


  public function setMessage($message){
    $this->message = $message;
    return $this;
  }


public function getMessage(){
    
    return $this->message;
  }


   /*
    @  insert
   */
    public function newcontact($response){

  $sql = "INSERT INTO Contact(id,nome, email , telefone , message) 
                      VALUES(:id ,:nome, :email, :telefone , :message)";

    $stmt = $this->getConnection()->prepare( $sql );
    $stmt->bindParam( ':id', $this->getId());
    $stmt->bindParam( ':nome', $this->getNome());
    $stmt->bindParam( ':email', $this->getEmail());
    $stmt->bindParam( ':telefone', $this->getTelefone());
    $stmt->bindParam( ':message', $this->getMessage());

    $result = $stmt->execute();

    }

    /*select all*/
    public function selctUsers($response)
    {

        $users = $this->getConnection()->query("SELECT * FROM Users" ,PDO::FETCH_ASSOC);

        return $this->getContainer()->view->render($response ,'admin/users/listarUser.twig', ["users"=>$users]);

    }

    /*  update users*/
    public function updateusers($response){


        $user =  "UPDATE Users set email=:email ,tipouser=:tipouser where id=:id";
        $stmt = $this->getConnection()->prepare($user);

        $stmt->bindParam("id" , $this->getId());
        $stmt->bindParam("email" , $this->getEmail());
        $stmt->bindParam("tipouser" , $this->getTipouser());
        $stmt->execute();

    }

    /* @ delete user*/
    public function deleteuser($response){

        $users =  "DELETE from Users where id=:id";
        $stmt= $this->getConnection()->prepare($users);
        $stmt->bindParam("id" , $this->getId());
        $stmt->execute();

    }

    public function getuserByemail($email){

      $user = $this->getConnection()->query("SELECT * FROM Users where email='$email'" ,PDO::FETCH_ASSOC);
      

      /*foreach ($user as $key => $value) {
        echo  $value['id'];
      }
      */

      return $user;

    }

    public function getuserBYId($id){

      $user = $this->getConnection()->query("SELECT * FROM Users where id='$id'" ,PDO::FETCH_ASSOC);
      return $user;
    }

    public function updatsenha($senha)
    {
      $user =  "UPDATE Users set senha=:senha , where id=:$_SESSION[id]";
      $stmt = $this->getConnection()->prepare($user);
      $stmt->bindParam("id" , $_SESSION['id']);
      $stmt->bindParam("senha" , $senha);
    }

    }
