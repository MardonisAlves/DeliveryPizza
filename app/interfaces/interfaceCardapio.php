<?php
namespace App\interfaces;

interface interfaceCardapio{

   public function getId();
   public function setId($id);
   public function getNomesabor();
   public function setNomesabor($nomesabor);
   public function getTamanho();
   public function setTamanho($tamanho);
   public function getValor();
   public function setValor($valor);
   public function getDescricao();
   public function setDescricao($descricao);
   public function getUrlimg();
   public function setUrlimg($urlimg);

}