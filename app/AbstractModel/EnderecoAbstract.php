<?php

namespace App\AbstractModel;
use App\AbstractModel\BaseAbstract; 

abstract class EnderecoAbstract extends BaseAbstract
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

    /** 
     * METHODOS ABSTRATOS
    */

 abstract public function Novoendereco();
 abstract public function getendeById();
 //abstract public function UpdateEndereco();
 //abstract public function Listarendereco();

}
