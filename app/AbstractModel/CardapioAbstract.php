<?php

namespace App\AbstractModel;
use App\AbstractModel\BaseAbstract; 

abstract class CardapioAbstract extends BaseAbstract
{
   private $id;
   private $nomesabor;
   private $tamanho;
   private $valor; 
   private $descricao;
   private $urlimg;

    /***
     * Methods abstratos
     */
    //abstract public function index();
    


    /**
     * Getters e Setters
     */
   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;

      return $this;
   }

   public function getNomesabor()
   {
      return $this->nomesabor;
   }

  
   public function setNomesabor($nomesabor)
   {
      $this->nomesabor = $nomesabor;

      return $this;
   }

   
   public function getTamanho()
   {
      return $this->tamanho;
   }

  
   public function setTamanho($tamanho)
   {
      $this->tamanho = $tamanho;

      return $this;
   }

  
   public function getValor()
   {
      return $this->valor;
   }

  
   public function setValor($valor)
   {
      $this->valor = $valor;

      return $this;
   }


   
   public function getDescricao()
   {
      return $this->descricao;
   }

  
   public function setDescricao($descricao)
   {
      $this->descricao = $descricao;

      return $this;
   }

  
   public function getUrlimg()
   {
      return $this->urlimg;
   }

    
   public function setUrlimg($urlimg)
   {
      $this->urlimg = $urlimg;

      return $this;
   }


}
