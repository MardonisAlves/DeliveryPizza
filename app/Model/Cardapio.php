<?php

namespace App\Model;

use App\AbstractModel\CardapioAbstract;

use PDO;

class Cardapio extends CardapioAbstract
{
  
   /*  
    @abstract  insert
   */
    public function insert(){

    $sql = "INSERT INTO Cardapio(id,nomesabor, tamanho,  valor  ,descricao , urlimg) 
    VALUES(:id ,:nomesabor, :tamanho, :valor , :descricao , :urlimg)";

    $stmt = $this->getConnection()  ->prepare( $sql );
    $stmt->bindParam( ':id', $this->getId());
    $stmt->bindParam( ':nomesabor', $this->getNomesabor());
    $stmt->bindParam( ':tamanho', $this->getTamanho() );
    $stmt->bindParam( ':valor', $this->getValor());
    $stmt->bindParam( ':descricao', $this->getDescricao());
    $stmt->bindParam( ':urlimg', $this->getUrlimg());

    $stmt->execute();

    }

    /* @abstract get Users*/
    public function selctUsers()
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

    }
