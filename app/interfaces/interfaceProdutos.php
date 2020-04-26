<?php
namespace App\interfaces;
interface interfaceProdutos{

/**
 *  precocompra
 */ 
public function getPrecocompra();
public function setPrecocompra($precocompra);

/**
 *  porcentagemvenda
 */ 
public function getPorcentagemvenda();
public function setPorcentagemvenda($porcentagemvenda);

/**
 * precovenda
 */ 
public function getPrecovenda();
public function setPrecovenda($precovenda);

/**
 *valortotalstoque
 */ 
public function getValortotalstoque();
public function setValortotalstoque($valortotalstoque);

/**
 * qtdade
 */ 
public function getQtdade();
public function setQtdade($qtdade);

/**
 *  datavalidade
 */ 
public function getDatavalidade();
public function setDatavalidade($datavalidade);

}