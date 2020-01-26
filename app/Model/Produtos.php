<?php

namespace App\Model;
use App\AbstractModel\Baseabstract;
use App\interfaces\interfaceProdutos;
use PDO;

class Produtos  extends BaseAbstract implements interfaceProdutos{

private $id;
private $nome;
private $desccricao;
private $precocompra;
private $porcentagemvenda;
private $precovenda;
private $valortotalstoque;
private $qtdade;
private $datavalidade;

    /* Produtos By Id*/
    public function ProdutosById($id){

        $idProduto = $this->getConnection()->query("SELECT * FROM Produtos where id=$id");

        
        while($pro = $idProduto->fetch())
        {
            $valor = floatVal( $pro['preco_compra']) * ($this->getQtdade());
        }

        return $valor;
    }
    public function listarProdutos()
    {
        $produto =  $this->getConnection()->query("SELECT * FROM Produtos");
        return $produto;

    }

    public function insertProdutos(){

       
    $newproduto = "INSERT INTO Produtos(id , nome, descricao ,
                                            preco_compra, porcentagem_venda,
                                            preco_venda, valor_total_stoque,
                                            qt_dade, date_validade)
                                            VALUES(
                                                :id , :nome, 
                                                :descricao ,
                                                :preco_compra,
                                                :porcentagem_venda,
                                                :preco_venda,
                                                :valor_total_stoque,
                                                :qt_dade,
                                                :date_validade)";
    $stmt = $this->getConnection()->prepare($newproduto);
    $stmt->bindParam("id" , $this->getId());
    $stmt->bindParam("nome" , $this->getNome());
    $stmt->bindParam("descricao" , $this->getDesccricao());
    $stmt->bindParam("preco_compra" ,$this->getPrecocompra());
    $stmt->bindParam("porcentagem_venda" , $this->getPorcentagemvenda());
                                            
    $stmt->bindParam("preco_venda" , $this->CalcularPrecovenda());

    $stmt->bindParam("valor_total_stoque" , $this->valorStoque());
    $stmt->bindParam("qt_dade" , $this->getQtdade());
    $stmt->bindParam("date_validade" , $this->getDatavalidade());
    $stmt->execute();
        

    }
    public function updateProduto()
    {   
    
       
            
        $produto = "UPDATE Produtos set qt_dade=:qt_dade,
        porcentagem_venda=:porcentagem_venda ,preco_compra=:preco_compra  , valor_total_stoque=:valor_total_stoque where id=:id";
        $stmt = $this->getConnection()->prepare($produto);
        $stmt->bindParam("id" , $this->getId());
        $stmt->bindParam("qt_dade" , $this->getQtdade());
        $stmt->bindParam("preco_compra" , $this->getPrecocompra());
        $stmt->bindParam("porcentagem_venda" , $this->getPorcentagemvenda());
        // atualizar total_valor_stoque
        $stmt->bindParam("valor_total_stoque" ,  $this->valorStoque());
        $stmt->execute();
        
        
    }

public function deleteProduto()
{
    $produto = "DELETE from Produtos where id=:id";
    $stmt = $this->getConnection()->prepare($produto);
    $stmt->bindParam("id" , $this->getId());
    $stmt->execute();
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
 * Get the value of nome
 */ 
public function getNome()
{
return $this->nome;
}

/**
 * Set the value of nome
 *
 * @return  self
 */ 
public function setNome($nome)
{
$this->nome = $nome;

return $this;
}

/**
 * Get the value of desccricao
 */ 
public function getDesccricao()
{
return $this->desccricao;
}

/**
 * Set the value of desccricao
 *
 * @return  self
 */ 
public function setDesccricao($desccricao)
{
$this->desccricao = $desccricao;

return $this;
}

/**
 * Get the value of precocompra
 */ 
public function getPrecocompra()
{
return $this->precocompra;
}

/**
 * Set the value of precocompra
 *
 * @return  self
 */ 
public function setPrecocompra($precocompra)
{
$this->precocompra = $precocompra;

return $this;
}

/**
 * Get the value of porcentagemvenda
 */ 
public function getPorcentagemvenda()
{
return $this->porcentagemvenda;
}

/**
 * Set the value of porcentagemvenda
 *
 * @return  self
 */ 
public function setPorcentagemvenda($porcentagemvenda)
{
$this->porcentagemvenda = $porcentagemvenda;

return $this;
}

/**
 * Get the value of precovenda
 */ 
public function getPrecovenda()
{
return $this->precovenda;
}

/**
 * Set the value of precovenda
 *
 * @return  self
 */ 
public function setPrecovenda($precovenda)
{
$this->precovenda = $precovenda;

return $this;
}

/**
 * Get the value of valortotalstoque
 */ 
public function getValortotalstoque()
{
return $this->valortotalstoque;
}

/**
 * Set the value of valortotalstoque
 *
 * @return  self
 */ 
public function setValortotalstoque($valortotalstoque)
{
$this->valortotalstoque = $valortotalstoque;

return $this;
}

/**
 * Get the value of qtdade
 */ 
public function getQtdade()
{
return $this->qtdade;
}

/**
 * Set the value of qtdade
 *
 * @return  self
 */ 
public function setQtdade($qtdade)
{
$this->qtdade = $qtdade;

return $this;
}

/**
 * Get the value of datavalidade
 */ 
public function getDatavalidade()
{
return $this->datavalidade;
}

/**
 * Set the value of datavalidade
 *
 * @return  self
 */ 
public function setDatavalidade($datavalidade)
{
$this->datavalidade = $datavalidade;

return $this;
}
}