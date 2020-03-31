<?php

namespace App\Model;
use App\AbstractModel\BaseAbstract;
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

    
    /*valor total stoque*/
    public function getvalorStoque(){

        $idProduto = $this->getConnection()->query("SELECT * FROM Produtos");

        
        while($pro = $idProduto->fetch())
        {
            $valor = floatVal( $this->getPrecocompra()) * ($this->getQtdade());
        }
        
            return $valor ;
        
        
    }

    
    /*
    *  callcular preço venda
    */
    public function CalcularPrecovenda(){

            $valor = floatVal( $this->getPrecocompra()) / 100 * ($this->getPorcentagemvenda());
            return $valor;
    }
    public function listarProdutos()
    {
        $produto =  $this->getConnection()->query("SELECT * FROM Produtos");
        return $produto;

    }

    /* Produtos By Id*/
    public function ProdutosById($id){

        $idProduto = $this->getConnection()->query("SELECT * FROM Produtos where id=$id");

        return $idProduto;
    }


    public function insertProdutos(){

       
    $newproduto = "INSERT INTO Produtos(id , nome, descricao ,
                                            precocompra, porcentagemvenda,
                                            precovenda, valortotalstoque,
                                            qtdade, datavalidade)
                                            VALUES(
                                                :id , :nome, 
                                                :descricao ,
                                                :precocompra,
                                                :porcentagemvenda,
                                                :precovenda,
                                                :valortotalstoque,
                                                :qtdade,
                                                :datavalidade)";
    $stmt = $this->getConnection()->prepare($newproduto);
    $stmt->bindParam("id" , $this->getId());
    $stmt->bindParam("nome" , $this->getNome());
    $stmt->bindParam("descricao" , $this->getDesccricao());
    $stmt->bindParam("precocompra" ,$this->getPrecocompra());
    $stmt->bindParam("porcentagemvenda" , $this->getPorcentagemvenda());
                                            
    $stmt->bindParam("precovenda" , $this->CalcularPrecovenda());

    $stmt->bindParam("valortotalstoque" , $this->getvalorStoque());
    $stmt->bindParam("qtdade" , $this->getQtdade());
    $stmt->bindParam("datavalidade" , $this->getDatavalidade());
    $stmt->execute();
        

    }
    public function updateProduto()
    {   
    
       
            
        $produto = "UPDATE Produtos set qtdade=:qtdade,
        porcentagemvenda=:porcentagemvenda ,precocompra=:precocompra  , valortotalstoque=:valortotalstoque where id=:id";
        $stmt = $this->getConnection()->prepare($produto);
        $stmt->bindParam("id" , $this->getId());
        $stmt->bindParam("qtdade" , $this->getQtdade());
        $stmt->bindParam("precocompra" , $this->getPrecocompra());
        $stmt->bindParam("porcentagemvenda" , $this->getPorcentagemvenda());
        // atualizar total_valor_stoque
        $stmt->bindParam("valortotalstoque" ,  $this->getvalorStoque());
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