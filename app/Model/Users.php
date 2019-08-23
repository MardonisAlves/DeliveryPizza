<?php

namespace App\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;
/**
* Blog User entity
*
* @Entity
*/
class Users
{



/**
* @Id  
* @GeneratedValue   
* @Column(type="integer")*/
public $id;

/**
* @var string
* @Column(type="string")
*
*/
protected $senha;

/**
* @var string
*
* @Column(type="string")
*/
protected $email;


/**
 * @var string
 *
 * @Column(type="string")
 *
 */
protected $fullName;

/**
 * @var string
 * @Column(type="string")
 *
 */
protected $typeUser;

// Array Collection


/** BIDIRECIONAL USERS
* @OneToMany(targetEntity="UsersClientes", mappedBy="user" ,cascade={"persist", "remove" , "refresh"})
     */
protected $usersclientes ;

public function __construct()
{
    $this->usersclientes= new ArrayCollection();
}


// METHODOS SET e GET

    public function getId()
    {
        return $this->id;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

  
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

  
    public function getEmail()
    {
        return $this->email;
    }

 
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

  
    public function getFullName()
    {
        return $this->fullName;
    }

    
    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    
    public function getTypeUser()
    {
        return $this->typeUser;
    }

   
    public function addUserscliente(\UsersClientes $userscliente)
    {
        $this->usersclientes[] = $userscliente;

        return $this;
    }



    public function removeUserscliente(\UsersClientes $userscliente)
    {
        return $this->usersclientes->removeElement($userscliente);
    }

  
    public function getUsersclientes()
    {
        return $this->usersclientes;
    }
}
