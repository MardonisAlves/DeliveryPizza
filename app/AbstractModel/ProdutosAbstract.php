<?php

namespace App\AbstractModel;
use App\AbstractModel\BaseAbstract;


abstract class ProdutosAbstract  extends BaseAbstract{
private $id;
private $nome;
private $desccricao;
private $precocompra;
private $porcentagemvenda;
private $precovenda;
private $valortotalstoque;
private $qtdade;
private $datavalidade;







/**
 *  id
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

/**
 *  nome
 */ 
public function getNome()
{
return $this->nome;
}

public function setNome($nome)
{
$this->nome = $nome;

return $this;
}

/**
 *  desccricao
 */ 
public function getDesccricao()
{
return $this->desccricao;
}

public function setDesccricao($desccricao)
{
$this->desccricao = $desccricao;

return $this;
}

/**
 *  precocompra
 */ 
public function getPrecocompra()
{
return $this->precocompra;
}

public function setPrecocompra($precocompra)
{
$this->precocompra = $precocompra;

return $this;
}

/**
 *  porcentagemvenda
 */ 
public function getPorcentagemvenda()
{
return $this->porcentagemvenda;
}

public function setPorcentagemvenda($porcentagemvenda)
{
$this->porcentagemvenda = $porcentagemvenda;

return $this;
}

/**
 * precovenda
 */ 
public function getPrecovenda()
{
return $this->precovenda;
}
public function setPrecovenda($precovenda)
{
$this->precovenda = $precovenda;

return $this;
}

/**
 *valortotalstoque
 */ 
public function getValortotalstoque()
{
return $this->valortotalstoque;
}

public function setValortotalstoque($valortotalstoque)
{
$this->valortotalstoque = $valortotalstoque;

return $this;
}

/**
 * qtdade
 */ 
public function getQtdade()
{
return $this->qtdade;
}


public function setQtdade($qtdade)
{
$this->qtdade = $qtdade;

return $this;
}

/**
 *  datavalidade
 */ 
public function getDatavalidade()
{
return $this->datavalidade;
}

public function setDatavalidade($datavalidade)
{
$this->datavalidade = $datavalidade;

return $this;
}



abstract public function insertProdutos();
abstract public function updateProduto();
abstract public function listarProdutos();
abstract public function deleteProduto();
/**
 * CalcularPrecovenda
 */ 


 
public function CalcularPrecovenda()
{

    $preco_compra = floatval($this->getPrecocompra());

    $porcentagemVenda= floatval($this->getPorcentagemvenda());

    
    $resVAlorVenda = $preco_compra / 100 * ($porcentagemVenda) + ($preco_compra);


    return  $resVAlorVenda;
}

public function valorStoque(){

    $valorstoque = $this->CalcularPrecovenda() * $this->getQtdade();

    return $valorstoque;
}

}