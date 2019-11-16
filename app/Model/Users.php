<?php

namespace App\Model;
use PDO;

class Users
{
    private $email;
    private $senha;
    private $tipouser;
    private $Connection;

  
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }
    
    public function setSenha($senha)
    {
        $this->senha = $senha;

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

    
    public function getConnection()
    {
        return $this->Connection;
    }


    public function setConnection($Connection)
    {
        $this->Connection = $Connection;

        return $this;
    }

    public function selctUsers()
    {
        $usuarios = $this->getConnection()->query("SELECT * FROM Users" ,PDO::FETCH_ASSOC);
    while($user = $usuarios->fetch()){
        print($user['id']);
        print($user['email']);
        
       
    }
    }
}