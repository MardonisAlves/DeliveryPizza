<?php

namespace App\Model;
use App\AbstractModel\BaseAbstract;
use App\interfaces\interfaceProdutos;
use PDO;

class Produtos  extends BaseAbstract implements interfaceProdutos{
    
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
public function CalcularPrecovenda()
{
    $valor = floatVal( $this->getPrecocompra()) / 100 * ($this->getPorcentagemvenda());
    return $valor;
}

public function listarProdutos()
{
    $produto =  $this->getConnection()->query("SELECT * FROM Produtos");
    return $produto;

}

    /* Produtos By Id*/
public function ProdutosById($id)
{
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
    $stmt->bindParam("nome" , $this->getNomesabor());
    $stmt->bindParam("descricao" , $this->getDescricao());
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
    $produto = "UPDATE Produtos set qtdade=:qtdade,porcentagemvenda=:porcentagemvenda ,precocompra=:precocompra  , valortotalstoque=:valortotalstoque where id=:id";
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
     * @return mixed
     */
    public function getPrecocompra()
    {
        return $this->precocompra;
    }

    /**
     * @param mixed $precocompra
     *
     * @return self
     */
    public function setPrecocompra($precocompra)
    {
        $this->precocompra = $precocompra;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPorcentagemvenda()
    {
        return $this->porcentagemvenda;
    }

    /**
     * @param mixed $porcentagemvenda
     *
     * @return self
     */
    public function setPorcentagemvenda($porcentagemvenda)
    {
        $this->porcentagemvenda = $porcentagemvenda;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrecovenda()
    {
        return $this->precovenda;
    }

    /**
     * @param mixed $precovenda
     *
     * @return self
     */
    public function setPrecovenda($precovenda)
    {
        $this->precovenda = $precovenda;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValortotalstoque()
    {
        return $this->valortotalstoque;
    }

    /**
     * @param mixed $valortotalstoque
     *
     * @return self
     */
    public function setValortotalstoque($valortotalstoque)
    {
        $this->valortotalstoque = $valortotalstoque;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQtdade()
    {
        return $this->qtdade;
    }

    /**
     * @param mixed $qtdade
     *
     * @return self
     */
    public function setQtdade($qtdade)
    {
        $this->qtdade = $qtdade;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatavalidade()
    {
        return $this->datavalidade;
    }

    /**
     * @param mixed $datavalidade
     *
     * @return self
     */
    public function setDatavalidade($datavalidade)
    {
        $this->datavalidade = $datavalidade;

        return $this;
    }
}