<?php

namespace App\Model;
use App\AbstractModel\UserAbstract;
use PDO;

class Users extends UserAbstract
{

   /*
    @abstract  insert
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

    /* @abstract get Users*/
    public function selctUsers($response)
    {

        $users = $this->getConnection()->query("SELECT * FROM Users" ,PDO::FETCH_ASSOC);

        return $this->getContainer()->view->render($response ,'admin/users/listarUser.twig', ["users"=>$users]);

    }

    /* @abstract update users*/
    public function updateusers($response){


        $user =  "UPDATE Users set email=:email ,tipouser=:tipouser where id=:id";
        $stmt = $this->getConnection()->prepare($user);

        $stmt->bindParam("id" , $this->getId());
        $stmt->bindParam("email" , $this->getEmail());
        $stmt->bindParam("tipouser" , $this->getTipouser());
        $stmt->execute();

    }

    /* @abstract delete user*/
    public function deleteuser($response){

        $users =  "DELETE from Users where id=:id";
        $stmt= $this->getConnection()->prepare($users);
        $stmt->bindParam("id" , $this->getId());
        $stmt->execute();

    }

    public function getuserByemail(){
      $user = $this->getConnection()->query("SELECT * FROM Users where email=:email" ,PDO::FETCH_ASSOC);
      $user->bindParam("email" , $this->getEmail());

      return $user;

    }

    }
