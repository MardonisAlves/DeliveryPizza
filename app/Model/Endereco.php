<?php

namespace App\Model;
use App\AbstractModel\BaseAbstract;
use App\interfaceEndereco;
use PDO;

class Endereco extends BaseAbstract implements interfaceEndereco
{

  private $id;
  private $id_user;
  private $rua;
  private $bairro;
  private $cep;
  private $cidade;
  private $referencia;
  private $numero;
  private $telefone;

   /*
    @abstract Novoendereco
   */
   /**
    * Undocumented function  Getters e Setters
    *
    * @return void
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


   public function getId_user()
   {
       return $this->id_user;
   }


   public function setId_user($id_user)
   {
       $this->id_user = $id_user;

       return $this;
   }


   public function getRua()
   {
       return $this->rua;
   }


   public function setRua($rua)
   {
       $this->rua = $rua;

       return $this;
   }

   public function getBairro()
   {
       return $this->bairro;
   }


   public function setBairro($bairro)
   {
       $this->bairro = $bairro;

       return $this;
   }


   public function getCep()
   {
       return $this->cep;
   }


   public function setCep($cep)
   {
       $this->cep = $cep;

       return $this;
   }


   public function getCidade()
   {
       return $this->cidade;
   }


   public function setCidade($cidade)
   {
       $this->cidade = $cidade;

       return $this;
   }


   public function getReferencia()
   {
       return $this->referencia;
   }


   public function setReferencia($referencia)
   {
       $this->referencia = $referencia;

       return $this;
   }


   public function getNumero()
   {
       return $this->numero;
   }


   public function setNumero($numero)
   {
       $this->numero = $numero;

       return $this;
   }


   public function getTelefone()
   {
       return $this->telefone;
   }

   public function setTelefone($telefone)
   {
       $this->telefone = $telefone;

       return $this;
   }



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
