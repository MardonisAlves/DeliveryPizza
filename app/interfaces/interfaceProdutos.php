<?php
namespace App\interfaces;
interface interfaceProdutos{

/**
 *  id
 */ 
public function getId();
public function setId($id);

/**
 *  nome
 */ 
public function getNome();
public function setNome($nome);

/**
 *  desccricao
 */ 
public function getDesccricao();
public function setDesccricao($desccricao);

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