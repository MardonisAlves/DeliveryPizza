<?php

namespace App\Model;

use PDO;

class Pizza extends BaseAbstract
{

   /*
    @abstract  insert
   */
    public function insertPizza(){

    $sql = "INSERT INTO Pizza(id,nomesabor, categoria, valorM , valorG  , descricao , urlimg)
    VALUES(:id ,:nomesabor, :categoria, :valorM , :valorG , :descricao , :urlimg)";

    $stmt = $this->getConnection()->prepare( $sql );
    $stmt->bindParam( ':id', $id);
    $stmt->bindParam( ':nomesabor', $_POST['nomesabor']);
    $stmt->bindParam( ':categoria', $_POST['categoria']);
    $stmt->bindParam( ':valorM', $_POST['valorM']);
    $stmt->bindParam( ':valorG', $_POST['valorG']);
    $stmt->bindParam( ':descricao', $_POST['descricao']);
    $stmt->bindParam( ':urlimg', $_FILES['urlimg']['name']);

    $stmt->execute();

    }


    public function insertDefault(){

    $sql = "INSERT INTO Pizza(id,nomesabor, categoria , valor , descricao , urlimg)
    VALUES(:id ,:nomesabor, :categoria  , :valor, :descricao , :urlimg)";

    $stmt = $this->getConnection()->prepare( $sql );
    $stmt->bindParam( ':id', $id);
    $stmt->bindParam( ':nomesabor', $_POST['nomesabor']);
    $stmt->bindParam( ':categoria', $_POST['categoria']);
    $stmt->bindParam(':valor' , $_POST['valor']);
    $stmt->bindParam( ':descricao', $_POST['descricao']);
    $stmt->bindParam( ':urlimg', $_FILES['urlimg']['name']);

    $stmt->execute();

    }


    /* @ getall cardapio*/
    public function selctAll($categoria)
    {
       $card  = $this->getConnection()->query("SELECT * FROM pizza where categoria='$categoria'");
      return $card;

    }

    /*@ select by id cardapio*/
    public function selectByid($id){

       $card  = $this->getConnection()->query("SELECT * FROM Pizza where id='$id'");
        return $card;


    }

    /* @ update cardapio*/
    public function updatePizza(){
        $card =  "UPDATE Pizza set valor=:valor  where id=:id";
        $stmt = $this->getConnection()->prepare($card);

        $stmt->bindParam("id" , $this->getId());
        $stmt->bindParam("valor" , $this->getValor());
        $stmt->execute();

    }

    /* @ delete cardapio*/
    public function excluirpizza(){

        $card =  "DELETE from Pizza where urlimg=:urlimg";
        $stmt= $this->getConnection()->prepare($card);
        $stmt->bindParam("urlimg" , $_GET['urlimg']);
        $stmt->execute();



    }

    /*get cardapio by categoria*/

    public function caizone($categoria){
    $caizone  = $this->getConnection()->query("SELECT * FROM Pizza where categoria='$categoria'");

        /*foreach ($caizone as $key => $value) {
            echo $value['codigo'];
        }
        */
        return $caizone;
    }



    }
