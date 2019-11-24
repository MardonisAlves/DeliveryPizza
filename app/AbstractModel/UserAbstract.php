<?php

namespace App\AbstractModel;
use App\AbstractModel\BaseAbstract; 

abstract class UserAbstract extends BaseAbstract
{
    private $id;
    private $email;
    private $nome;
    private $senha;
    private $tipouser;



    public function getId()
    {
        return $this->id;
    }

   
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
  
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }
    
    public function setSenha($senha)
    {
        $this->senha = (password_hash($senha,PASSWORD_DEFAULT));

        return $this;
    }

  
    public function getTipouser()
    {
        return $this->tipouser;
    }

    public function setTipouser($tipouser)
    {
        $this->tipouser = $tipouser;

        return $this;
    }



    // iinsert user
    abstract public function insert($response);
    // get All Users
   abstract  public function selctUsers($response);

    // update users

  abstract  public function updateusers($response);

    // delete user
  abstract  public function deleteuser($response);

    }
