<?php

namespace App\Model;
use App\AbstractModel\BaseAbstract;
use App\interfaces\interfaceUser;
use PDO;

class Users extends BaseAbstract implements interfaceUser
{

  private $id;
  private $email;
  private $nome;
  private $senha;
  private $tipouser;

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
   /*
    @  insert
   */
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
