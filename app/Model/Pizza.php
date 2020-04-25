<?php

namespace App\Model;
use App\AbstractModel\BaseAbstract;
use App\AbstractModel\CardapioAbstract;
use App\interfaces\interfaceCardapio;

use PDO;

class Pizza extends BaseAbstract implements interfaceCardapio
{
    private $id;
    private $categoria;
    private $nomesabor;
    private $valorM; 
    private $valorG; 
    private $descricao;
    private $urlimg;
    
   /*  
    @abstract  insert
   */
    public function insert(){

    $sql = "INSERT INTO Pizza(id,nomesabor, categoria, valorM , valorG ,descricao , urlimg) 
    VALUES(:id ,:nomesabor, :categoria, :valorM , :valorG , :descricao , :urlimg)";

    $stmt = $this->getConnection()->prepare( $sql );
    $stmt->bindParam( ':id', $this->getId());
    $stmt->bindParam( ':nomesabor', $_POST['nomesabor']);
    $stmt->bindParam( ':categoria', $this->getCategoria());
    $stmt->bindParam( ':valorM', $this->getValorM());
    $stmt->bindParam( ':valorG', $this->getValorG());
    $stmt->bindParam( ':descricao', $this->getDescricao());
    $stmt->bindParam( ':urlimg', $this->getUrlimg());

    $stmt->execute();

    }

    /* @ getall cardapio*/
    public function selctAll()
    {
       $card  = $this->getConnection()->query("SELECT * FROM pizza");
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
        $stmt->bindParam("urlimg" , $this->getUrlimg());
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
    

    /**
     * Get the value of valorM
     */ 
    public function getValorM()
    {
        return $this->valorM;
    }

    /**
     * Set the value of valorM
     *
     * @return  self
     */ 
    public function setValorM($valorM)
    {
        $this->valorM = $valorM;

        return $this;
    }

    /**
     * Get the value of valorG
     */ 
    public function getValorG()
    {
        return $this->valorG;
    }

    /**
     * Set the value of valorG
     *
     * @return  self
     */ 
    public function setValorG($valorG)
    {
        $this->valorG = $valorG;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }
    }
