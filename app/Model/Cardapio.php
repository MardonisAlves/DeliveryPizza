<?php

namespace App\Model;
use App\AbstractModel\BaseAbstract;
use App\AbstractModel\CardapioAbstract;
use App\interfaces\interfaceCardapio;

use PDO;

class Cardapio extends BaseAbstract implements interfaceCardapio
{
    private $id;
    private $nomesabor;
    private $tamanho;
    private $valor; 
    private $descricao;
    private $urlimg;
    
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

    /* @ getall cardapio*/
    public function selctAll()
    {
       $card  = $this->getConnection()->query("SELECT * FROM Cardapio");
      return $card;
      
    }

    /*@ select by id cardapio*/
    public function selectByid($id){
    
       $card  = $this->getConnection()->query("SELECT * FROM Cardapio where id='$id'");
        return $card;
      
      
    }

      /*get caizone by codigo*/

    public function caizone(){
        $caizone  = $this->getConnection()->query("SELECT codigo FROM Cardapio");
        
        /*foreach ($caizone as $key => $value) {
            echo $value['codigo'];
        }
        */
        return $caizone; 
    }
    

    /* @ update cardapio*/
    public function updatePizza(){
        $card =  "UPDATE Cardapio set valor=:valor  where id=:id";
        $stmt = $this->getConnection()->prepare($card);

        $stmt->bindParam("id" , $this->getId());
        $stmt->bindParam("valor" , $this->getValor());
        $stmt->execute();

    }

    /* @ delete cardapio*/ 
    public function excluircardapio(){

        $card =  "DELETE from Cardapio where urlimg=:urlimg";
        $stmt= $this->getConnection()->prepare($card);
        $stmt->bindParam("urlimg" , $this->getUrlimg());
        $stmt->execute();

       
          
    }


    /**
     * Get the value of nomesabor
     */ 
    public function getNomesabor()
    {
        return $this->nomesabor;
    }

    /**
     * Set the value of nomesabor
     *
     * @return  self
     */ 
    public function setNomesabor($nomesabor)
    {
        $this->nomesabor = $nomesabor;

        return $this;
    }

    /**
     * Get the value of tamanho
     */ 
    public function getTamanho()
    {
        return $this->tamanho;
    }

    /**
     * Set the value of tamanho
     *
     * @return  self
     */ 
    public function setTamanho($tamanho)
    {
        $this->tamanho = $tamanho;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of urlimg
     */ 
    public function getUrlimg()
    {
        return $this->urlimg;
    }

    /**
     * Set the value of urlimg
     *
     * @return  self
     */ 
    public function setUrlimg($urlimg)
    {
        $this->urlimg = $urlimg;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    
    }
