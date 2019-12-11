<?php

namespace App\Model;
use App\AbstractModel\EnderecoAbstract;
use PDO;

class Endereco extends EnderecoAbstract
{
  
   /*  
    @abstract Novoendereco
   */
public function Novoendereco(){

$endereco = "INSERT INTO Endereco(id ,user_id , rua ,bairro , cep ,cidade , referencia ,numero , telefone)
VALUES(:id , :user_id , :rua , :bairro , :cep , :cidade ,:referencia , :numero , :telefone)";

$ende = $this->getConnection()->prepare($endereco);
$ende->bindParam(":id" , $this->getId());
$ende->bindParam(":user_id" , $this->getId_user());
$ende->bindParam(":rua" , $this->getRua());
$ende->bindParam(":bairro" , $this->getBairro());
$ende->bindParam(":cep" , $this->getCep());
$ende->bindParam(":cidade" , $this->getCidade());
$ende->bindParam(":referencia" , $this->getReferencia());
$ende->bindParam(":numero" , $this->getNumero());
$ende->bindParam(":telefone" , $this->getTelefone());
$ende->execute();

    
}

public function getendeById($id){

    $getidende = $this->getConnection()->query("SELECT * from Endereco where user_id:$id");

    return $getidende;
}

    

    }
