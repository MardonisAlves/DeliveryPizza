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

    /* @abstract get cardapio*/
    public function selctAll($response)
    {
       $card  = $this->getConnection()->query("SELECT * FROM Cardapio" ,PDO::FETCH_ASSOC);

      return $card;
      
    }

    /* @abstract update users*/
    public function updatePizza(){


        $card =  "UPDATE Cardapio set valor=:valor  where id=:id";
        $stmt = $this->getConnection()->prepare($card);

        $stmt->bindParam("id" , $this->getId());
        $stmt->bindParam("valor" , $this->getValor());
        $stmt->execute();

    }

    /* @abstract delete user*/ 
    public function excluircardapio(){

        $card =  "DELETE from Cardapio where id=:id";
        $stmt= $this->getConnection()->prepare($card);
        $stmt->bindParam("id" , $this->getId());
        $stmt->execute();
          
    }

    }
