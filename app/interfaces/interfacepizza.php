<?php
namespace App\interfaces;

interface interfacepizza{

   public function getId();
   public function setId($id);
   public function getNomesabor();
   public function setNomesabor($nomesabor);
   public function getCategoria();
   public function setCategoria($categoria);
   public function getValorM();
   public function setValorM($valorM);
   public function getValorG();
   public function setValorG($valorG);
   public function getDescricao();
   public function setDescricao($descricao);
   public function getUrlimg();
   public function setUrlimg($urlimg);

}