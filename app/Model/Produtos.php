<?php

namespace App\Model;
use App\AbstractModel\ProdutosAbstract;
use PDO;

class Produtos  extends ProdutosAbstract{
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

}